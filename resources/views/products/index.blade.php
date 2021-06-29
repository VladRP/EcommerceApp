@extends('layouts.app')

@section('content')
    @foreach($products->chunk(6) as $collection)
        <div class="row mt-3">
            @foreach($collection as $product)
                <div class="col-md-2 col-sm-6">
                    <div class="card mb-30"><a class="card-img-tiles" href="{{route('products.show', $product->id)}}" data-abc="true">
                        <div class="inner">
                            <div class ="main-img"><img style="max-width:100%" src="{{asset('storage/images/'.$product->image)}}"  alt="Category"></div>
                            </div>
                            </a>
                        </div>
                <div class="card-body text-center">
                    <h4 class="card-title">{{$product->title}}</h4>
                    @if($product->stock!=0)
                        <p>In stock</p>
                    @else
                        <p>Out of stock</p>
                    @endif
                    <p>Price: {{$product->price}}{{Config::get('constants.CURRENCY')}}</p>
                    </p><a class="btn btn-outline-primary btn-sm" href="/products/{{$product->id}}" data-abc="true">View Products</a>
                    <form method="POST" action="{{route('cartitems.addProduct', $product->id)}}">
                        @csrf
                        @method('PUT')
                    <div class = "form-group">
                        <input type="hidden" class="form-control" name="quantity" value="1">
                        <button class="btn btn-primary" type="submit">Addtocart</button>
                    </div>
                    </form>
                    @if(Auth::user())
                        @if(Auth::user()->isAdmin == 1)
                            <form action="/products/{{ $product->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <a style="width:100%" href="{{route('products.edit', $product->id)}}" class="btn btn-primary">
                                Edit
                            </a>    
                            <button style="width:100%" type="submit" class="btn btn-danger ">Delete</button>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    @endforeach
    @if(Auth::user())
    @if(Auth::user()->isAdmin == 1)
        <div class="row">
        <h1 class="text-5xl uppercase bold">
            Sold out products
            </h1>
        </div>
        <table>
            <thead>
                <th>Id</th>
                <th>Title</th>
                <th>Deletefromcustomercarts</th>
                <th>AddStock</th>
            </thead>
            @foreach($products as $product)
                @if($product->stock==0)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>
                            <form action="{{route('cartitems.deletesoldout', $product->id)}}" method="POST"> 
                                @csrf
                                @method('delete')
                                <button tpye="submit">Delete</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('products.addstock', $product->id)}}" method="POST">
                                @csrf
                                @method('put')
                                <input type="number" name="added_stock">
                                <button type="submit">Addstock</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    @endif
    @endif
@endsection
