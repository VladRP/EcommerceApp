@extends('layouts.app')

@section('content')

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Instock</th>
            <th>Brand</th>
        </tr>
        @foreach($results as $product) 
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->instock}}</td>
                <td>{{$product->brand}}</td>
            </tr>
        @endforeach
        </table>

@endsection