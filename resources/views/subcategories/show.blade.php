@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <a href="{{route('categories.show', $subcategory->category->id)}}">Back to main category</a>
            <h1 class="text-5xl uppercase bold">
                {{$subcategory->title}}
            </h1>
            @if(Auth::user())
                @if(Auth::user()->isAdmin == 1)
                    <h3>
                        <a style="color:black" href="{{route('products.create', $subcategory->id)}}">Create new product</a> 
                    </h3>
                @endif
            @endif
            <p>
                {{$subcategory->description}}
            </p>
        </div>
    <div>
    @foreach($subcategory->product->chunk(4) as $products) 
        <div class="container mt-100">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 col-sm-6">
                        <div class="card mb-30"><a class="card-img-tiles" href="{{route('products.show', $product->id)}}" data-abc="true">
                            <div class="inner">
                                <div class ="main-img">
                                    <img style="max-width:100%" src="{{asset('storage/images/'.$product->image)}}"  alt="Category"></div>
                                </div>
                            </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{$product->title}}</h4>
                                <p> Price: {{$product->price}} {{Config::get('constants.CURRENCY')}}</p>
                                <a class="btn btn-outline-primary btn-sm" href="{{route('products.show', $product->id)}}" data-abc="true">View Product</a>
                                <form method="POST" action="{{route('cartitems.addProduct', $product->id)}}">
                                    @csrf
                                    @method('PUT')
                                <div class = "form-group">
                                    <input type="hidden" class="form-control" name="quantity" value="1">
                                    <button class="btn btn-primary" type="submit">Addtocart</button>
                                </div>
                                </form>
                            </div>
                            @if(Auth::user())
                                @if(Auth::user()->isAdmin)
                                    <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary" style="width:100%">
                                        Edit
                                    </a>
                                    <form action="/products/{{ $product->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" style="width:100%;">
                                            Delete
                                        </button>
                                    </form>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection     
   