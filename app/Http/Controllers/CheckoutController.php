<?php

namespace App\Http\Controllers;

use App\Models\Cartitem;
use App\Models\Order;
use App\Models\Storeditem; 
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        header('Content-Type: application/json');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        session(['from_checkout_controller' => 'exists']);
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
//                STATIC ARRAY FOR DEMO
//                'price_data' => [
//                    'currency' => 'inr',
//                    'unit_amount' => $price * 100,
//                    'product_data' => [
//                        'name' => 'Static Product',
//                        'images' => ["https://placehold.it/350x250"],
//                    ],
//                ],
//                'quantity' => 1,
                $this->lineItems()
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/success',
            'cancel_url' => 'http://localhost:8000/cancel',
        ]);
        
        return response()->json(['id' => $checkout_session->id]);
    }

    private function lineItems()
    {
        $cartitems = Cartitem::where('user_id', Auth::id())->get();
        $lineItems = [];
        foreach ($cartitems as $cartitem) {
            if($cartitem->quantity == 0){
                $cartitem->quantity +=1;                        //Update transport to be a valid cart item
                $cartitem->product->title ='transport';
                $cartitem->product->price = $cartitem->total_price;
            }
            $product['price_data'] = [
                'currency' => 'RON',
                'unit_amount' => $cartitem->product->price * 100,
                'product_data' => [
                    'name' => $cartitem->product->title,
                    ],
            ];
            $product['quantity'] = $cartitem->quantity;
            $lineItems[] = $product;
        }

        return $lineItems;
    }

    public function success(Request $request)
    {   
        $referer = request()->headers->get('referer'); //previous link
        if($referer!=null || session('from_checkout_controller')!=null){  //check if succes page is accesed correctly
            Auth::id();
            $cartitems = Cartitem::where('user_id', Auth::id())->get();
            if($referer!=null){ //create courier payment order
                $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $cartitems->sum('total_price'),
                'payment_method' => 'courier'
                ]);
            }
            if(session('from_checkout_controller')!=null){ //create card payment order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $cartitems->sum('total_price'),
                    'payment_method' => 'card'
                ]);
            }
            //Add cartitems to order
            foreach($cartitems as $cartitem){
                $cartitem->product->stock -= $cartitem->quantity; //sustract cartitem quantity from product stock
                $cartitem->product->save();
                Storeditem::create([
                    'order_id' => $order->id,
                    'stored_item_name' => $cartitem->product->title,
                    'stored_item_quantity' => $cartitem->quantity,
                    'stored_item_total_price' => $cartitem->total_price,
                ]);
            }
            Cartitem::where('user_id', Auth::id())->delete(); //delete cartitem from user shopping cart and db
            session()->forget('from_checkout_controller');

            return view('success');
        }

    return abort(404); //return not found if page is accesed directly
    }
        
    public function cancel()
        {
            return view('cancel');
        }
}
