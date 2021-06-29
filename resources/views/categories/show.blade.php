@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <a href="/categories">Go back to categories</a>
            <h1 class="text-5xl uppercase bold">
                {{$category->title}}
            </h1>
            @if(Auth::user())
                @if(Auth::user()->isAdmin == 1)
                    <h3>
                        <a style="color:black" href="/subcategories/create/{{$category->id}}">
                            Create new subcategory
                        </a>
                    <h3>
                @endif
            @endif
            <p>{{$category->description}}</p>
        </div>
        <div class="w-5/6 py-10">
            @if($category->subCategory)
                @foreach($category->subCategory as $subcategory)
                    <div class="m-auto w-4/5 py-24">
                        <div class="text-center">
                            <a style ="color:black" href="/subcategories/{{ $subcategory->id}}">
                                <h2 class="text-secondary">
                                    {{$subcategory->title}}
                                </h2>
                                <p class="text-secondary">
                                    {{$subcategory->description}}
                                </p>
                                <div class="inner">
                                    <img src="{{asset('storage/images/'.$subcategory->image)}}" style="max-width:100%" alt="Subcategory">
                                </div>
                            </a>
                            @if(Auth::user())
                                @if(Auth::user()->isAdmin == 1)
                                    <form action="/subcategories/{{ $subcategory->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="/subcategories/{{$subcategory->id}}/edit" class="btn btn-primary">
                                            Edit
                                        </a>
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @if($subcategory->product->count()>=3)
                    <div class="text-center">   
                        <div class="row mt-3">
                            @foreach($subcategory->product->random(4) as $product)
                                <div class="col-md-3 col-sm-3">
                                    <div class="card mb-30"><a style="color:black" class="card-img-tiles" href="/products/{{$product->id}}" data-abc="true">
                                        <div class="inner">
                                            <img src="{{asset('storage/images/casti.jpg')}}" style="max-width:100%" alt="Product">
                                        </div>
                                    <div>
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{$product->title}}</h4>
                                        <p>Price: {{$product->price}}{{Config::get('constants.CURRENCY')}}</p>
                                        <a href="/products/{{$product->id}}" class="btn btn-outline-primary btn-sm" href="#" data-abc="true">View Product</a>
                                        @if(Auth::user())
                                            @if(Auth::user()->isAdmin == 1)
                                                <div>
                                                    <a href="products/{{ $product->id}}/edit" class="btn btn-primary">
                                                        Edit
                                                    </a>
                                                </div>
                                                <form action="/product/{{ $product->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger ">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                @endif
            @endforeach
        </div>
        </div>
    @endif
@endsection            
