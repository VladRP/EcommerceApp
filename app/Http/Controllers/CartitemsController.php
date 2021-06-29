<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cartitem;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Gate;
use Config;

class CartitemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartitems = Cartitem::where("user_id", Auth::id())->get();

        return view('cartitems.index')->with('cartitems', $cartitems); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartitem = Cartitem::find($id);
        $cartitem->delete();
        $this->updateTaxTransport();

        return redirect()->back();
    }

    public function addProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $cartitem = Cartitem::where('product_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();
        if($cartitem!=null){ //add quantity to a existing cartitem
            $cartitem->quantity = $cartitem->quantity + $request->quantity;
            $cartitem->total_price = $cartitem->quantity * $product->price;
            $cartitem->save();
            $this->updateTaxTransport(); //check and update transport

            return redirect()->back();
        }
        Cartitem::create([
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
            'total_price'=> $request->input('quantity') * $product->price,
            'user_id' => Auth::id(),
            ]);
        $this->updateTaxTransport(); //check and update transport

        return redirect()->back();
    }

    public function increaseQuantity($id)
    {
        $cartitem = Cartitem::find($id);
        $cartitem->quantity += 1;
        $cartitem->total_price = $cartitem->quantity * $cartitem->product->price;
        $cartitem->save();
        $this->updateTaxTransport();

        return redirect()->back();
    }

    public function decreaseQuantity($id)
    {
        $cartitem = Cartitem::find($id);
        if($cartitem->quantity!=1){
            $cartitem->quantity -= 1;
            $cartitem->total_price = $cartitem->quantity * $cartitem->product->price;
            $cartitem->save();
        }
        $this->updateTaxTransport();

        return redirect()->back();
    }

    public function deleteCartItemsSoldOut($id)
    {
        if(Gate::allows('admin-only', auth()->user())){
        $cartitem = Cartitem::where('product_id', $id);
        $cartitem->delete();

        return redirect()->back();
        }

        return abort(404);
    }

    public function updateTaxTransport()
    {
        $cartitems = Cartitem::where('user_id', Auth::id());
        $product = Product::all()->first();
        $product_id = $product->id;
        $verifyItem = Cartitem::where('quantity', 0)->first();
        //Add tax transport
        if($cartitems->sum('total_price')<=Config::get('constants.TRANSPORT_FREE') && !isset($verifyItem->id)){
            Cartitem::create([
                'product_id' => $product_id,
                'quantity' => 0,
                'total_price'=> 20,
                'user_id' => Auth::id(),
            ]);
        }
        //Delete tax transport
        if(($cartitems->sum('total_price')>Config::get('constants.TRANSPORT_FREE') || $cartitems->sum('total_price')==Config::get('constants.TRANSPORT_TAX')) && isset($verifyItem)){
            $cartitem = Cartitem::where('quantity', 0);
            $cartitem->delete();
        }
    }
}
