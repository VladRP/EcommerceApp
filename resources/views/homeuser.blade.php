@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                {{Auth::user()->name}}
            </h1>
            <a class="btn btn-success" href='\categories'>Continue shopping</a>
            <a class="btn btn-primary" href="\cartitems" >Go to shopping cart</a>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="{{route('user.updateaddress', Auth::id())}}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <input
                    type="text"
                    class="form-control"
                    value={{Auth::user()->country}}
                    name="country">
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
            </div>       
            <div class="form-group">
                <input
                    type="text"
                    class="form-control"
                    name="city"
                    value={{Auth::user()->city}}>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="form-group">   
                <input
                    type="text"
                    class="form-control"
                    name="address"
                    value={{Auth::user()->address}}>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">
                Update Address
            </button>
        </form>
    </div>
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Your Orders
            </h1>
        </div>
    </div>
    <table>
        <tr>
            <th>Order number</th>
            <th>Order total price</th>
            <th>Placed at</th>
            <th>Address</th>
            <th>Payment method</th>
            <th>Contact Number</th>
            <th>Delivered</th>
            <th>Received</th>
        </tr>
        @foreach(Auth::user()->order as $order) 
            <tr>
                <td><a href="{{route('orders.showone', $order->id)}}">{{$order->id}}</a></td>
                <td>{{$order->total_price}} {{Config::get('constants.CURRENCY')}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->user->address}}</td>
                <td>{{$order->payment_method}}</td>
                <td>{{$order->user->phone}}</td>
                @if($order->delivered == 1)
                    <td>Delivered</td>
                @else
                    <td>Not Delivered</td>
                @endif
                @if($order->received == 1)
                    <td>Received</td>
                @else
                    <td>Not Received</td>
                @endif
            <tr>
        @endforeach
@endsection
