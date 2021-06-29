@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Orders Panel
            </h1>
            <a class="btn btn-primary" href="{{route('products.index')}}">View Products</a>
        </div>
    </div>
    @if($orders)
        <h2> To Deliver </h2>
        <table>
            <tr>
                <th>Order_id</th>
                <th>Order_total_price</th>
                <th>Currency</th>
                <th>Placed_at</th>
                <th>Name_of_the_customer</th>
                <th>Country</th>
                <th>City</th>
                <th>Address</th>
                <th>PhoneNumber</th>
                <th>Delivered</th>
                <th>Received</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            @foreach($orders as $order) 
                @if($order->delivered == 0 && $order->received == 0)
                    <tr>
                        <td><a href="{{route('orders.showone', $order->id)}}">{{$order->id}}</a></td>
                        <td>{{$order->total_price}}</td>
                        <td>{{Config::get('constants.CURRENCY')}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->user->country}}</td>
                        <td>{{$order->user->city}}</td>
                        <td>{{$order->user->address}}</td>
                        <td>{{$order->user->phone}}</td>
                        <form action = "{{route('orders.update', $order->id)}}"> 
                        <td>
                            @if($order->delivered == 1)
                                <input class="" type="checkbox" value="1" name="delivered" checked>
                            @else
                                <input class="" type="checkbox" value="0" name="delivered">
                            @endif
                        </td>
                        <td>
                            @if($order->received == 1)
                                <input class="" type="checkbox" value="1" name="received" checked>
                            @else
                                <input class="" type="checkbox" value="0" name="received">
                            @endif
                        </td>
                        <td>
                            <button type=submit>Update</button>
                        </td>
                        </form>
                        <form action="/orders/delete/{{$order->id}}" method="POST">
                            @csrf
                            @method('delete')
                            <td>
                                <button type="submit">Delete</button>
                            </td>
                        </form>
                    <tr>
                @endif
            @endforeach
        </table>
    <h2> To be received </h2>
    <table>
        <tr>
            <th>Order id</th>
            <th>Order total_price</th>
            <th>Currency</th>
            <th>Placed at</th>
            <th>Name of the customer</th>
            <th>Country</th>
            <th>City</th>
            <th>Address</th>
            <th>PhoneNumber</th>
            <th>Delivered</th>
            <th>Received</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        @foreach($orders as $order) 
            @if($order->delivered == 1 && $order->received == 0)
                <tr>
                    <td><a href="{{route('orders.showone', $order->id)}}">{{$order->id}} </a></td>
                    <td>{{$order->total_price}}</td>
                    <td>{{Config::get('constants.CURRENCY')}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->user->country}}</td>
                    <td>{{$order->user->city}}</td>
                    <td>{{$order->user->address}}</td>
                    <td>{{$order->user->phone}}</td>
                    <form action = "{{route('orders.update', $order->id)}}"> 
                    <td>
                        @if($order->delivered == 1)
                            <input class="" type="checkbox" value="1" name="delivered" checked>
                        @else
                            <input class="" type="checkbox" value="0" name="delivered">
                        @endif
                    </td>
                    <td>
                        @if($order->received == 1)
                            <input class="" type="checkbox" value="1" name="received" checked>
                        @else
                            <input class="" type="checkbox" value="0" name="received">
                        @endif
                    </td>
                    <td>
                        <button type=submit>Update</button>
                    </td>
                    </form>
                    <form action="/orders/delete/{{$order->id}}" method="POST">
                        @csrf
                        @method('delete')
                    <td>
                        <button type="submit">Delete</button>
                    </td>
                    </form>
                <tr>
            @endif
        @endforeach
    </table>
    <h2> Received </h2>
        <table>
            <tr>
                <th>Order id</th>
                <th>Order total price</th>
                <th>Currency</th>
                <th>Placed at</th>
                <th>Name of the customer</th>
                <th>Country</th>
                <th>City</th>
                <th>Address</th>
                <th>PhoneNumber</th>
                <th>Payment method</th>
                <th>Delivered</th>
                <th>Received</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            @foreach($orders as $order) 
                @if($order->delivered == 1 && $order->received == 1)
                    <tr>
                        <td><a href="{{route('orders.showone', $order->id)}}">{{$order->id}} </a></td>
                        <td>{{$order->total_price}}</td>
                        <td>{{Config::get('constants.CURRENCY')}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->user->country}}</td>
                        <td>{{$order->user->city}}</td>
                        <td>{{$order->user->address}}</td>
                        <td>{{$order->user->phone}}</td>
                        <td>{{$order->payment_method}}</td>
                        <form action = "{{route('orders.update', $order->id)}}"> 
                        <td>
                        @if($order->delivered == 1)
                            <input class="" type="checkbox" value="1" name="delivered" checked>
                        @else
                            <input class="" type="checkbox" value="0" name="delivered">
                        @endif
                        </td>
                        <td>
                        @if($order->received == 1)
                            <input class="" type="checkbox" value="1" name="received" checked>
                        @else
                            <input class="" type="checkbox" value="0" name="received">
                        @endif
                        </td>
                        <td>
                            <button type=submit>Update</button>
                        </td>
                        </form>
                        <form action="/orders/delete/{{$order->id}}" method="POST">
                            @csrf
                            @method('delete')
                        <td>
                            <button type="submit">Delete</button>
                        </td>
                        </form>
                    <tr>
                @endif
            @endforeach
        </table>
    @endif
@endsection
