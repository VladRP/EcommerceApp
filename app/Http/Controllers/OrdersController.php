<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function showOrders()
    {
        if(Gate::allows('admin-only', auth()->user())){
            $orders = Order::all();

            return view('home')->with('orders', $orders);
        }

        return abort(403);
    }

    public function showOrder($id)
    {
        $order = Order::find($id);

        return view('orders.order')->with('order', $order);
    }

    public function updateOrder(Request $request, $id)
    {
        if(Gate::allows('admin-only', auth()->user())){
        $order = Order::find($id);
            if($request->input('delivered')!=null){
            $order->delivered = 1;
            }
            if($request->input('delivered')==null){
                $order->delivered = 0;
            }
            if($request->input('received')!=null){
                $order->received = 1;
            }
            if($request->input('received')==null){
                $order->received = 0;
            }
        $order->save();

        return redirect()->back();
        }
        
        return abort(403);
    }

    public function delete($id)
    {
        if(Gate::allows('admin-only', auth()->user())){
            $order = Order::find($id);
            $order->delete();
        }
        
        return redirect()->back();
    }   
}
