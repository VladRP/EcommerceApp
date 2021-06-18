@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                {{$subcategory->title}}
            </h1>

            <p>
                {{$subcategory->description}}
            </p>
      
        </div>
    </div>

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Instock</th>
            <th>Brand</th>
        </tr>
        @foreach($subcategory->product as $product) 
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->instock}}</td>
                <td>{{$product->brand}}</td>
                <td>
                <a href="{{route('products.addToCart', $product->id)}}">
                    AddToCart
                </a>
                </td>
            </tr>
        @endforeach
        </table>

        <a href="/products/create/{{$subcategory->id}}">
            Create new product 
        </a>


    <div class="w-5/6 py-10">
       {{-- @foreach($category->subCategory as $subcategory)

      
        <div class="m-auto">
                
            <h2 class="text-gray-700 text-5xl">
                {{$subcategory->title}}
            </h2>
            <p class="text-lg text-gray-700 py-6">
                {{$subcategory->description}}
            </p>
        </div>

        @endforeach
  --}}
  

@endsection        