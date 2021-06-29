@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <a href="/">
                Go back to categories
            </a>
            <h1> Order nr. : {{$order->id}} </h1>
            <h2> {{$order->total_price}} {{Config::get('constants.CURRENCY')}} </h2>
            <h4> Payment method: {{$order->payment_method}}</h4>
        </div>
    </div>
    <h4>Information about customer</h4>
    <p>Name: {{$order->user->name}}</p>
    <p>Country: {{$order->user->country}}</p>
    <p>City: {{$order->user->city}}</p>
    <p>Address: {{$order->user->address}}</p>
    <p>Phone: {{$order->user->phone}}</p>
    <h4>Information about products</h4>
    @foreach($order->storeditems as $storeditem)
        @if($storeditem->stored_item_quantity==0)
            <p> Transport: {{$storeditem->stored_item_total_price}}</p>
        @endif
        @if($storeditem->stored_item_quantity>0)
            <p>Product name: {{$storeditem->stored_item_name}} </p>
            <p>Quantity: {{$storeditem->stored_item_quantity}}</p>
            <p>Price: {{$storeditem->stored_item_total_price}}</p>
        @endif
    @endforeach
@endsection
