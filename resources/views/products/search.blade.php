@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <p><a href="/">Go back to categories></a></p>
            <h1>Your search results: {{$results->count()}} products<h1>
        </div>
    </div>
    @foreach($results as $product)
        <a style="color:black" href="products/{{$product->id}}">
            <h3 class="text-5xl uppercase bold">
                {{$product->title}}
            </h3>
        </a>
        <div class="row mb-3">
            <div class="col">
                <img style="max-width:100%; max-height:150%" src="{{asset('storage/images/'.$product->image)}}">
            </div>
            <div class="col-6">
                <p>Product Brand: {{$product->brand}}</p>
                <p>{{$product->description}}<p>
            </div>
            <div class="col">
                <form method="POST" action="{{route('cartitems.addProduct', $product->id)}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="price" value="{{$product->price}}">
                <div class="form-group">
                    Qnty.:<input style="width: 95px;" type="number" min="1" max="{{round($product->stock/10 + 5)}}" onchange="multiply(this)" name="quantity" value="1">
                </div>
                <div class="form-group">
                    Price:<input style="width:95px" tpye="number" name="total_price" value="{{$product->price}}" readonly>{{Config::get('constants.CURRENCY')}}
                </div>
                    <button class="btn btn-primary" type="submit">Addtocart</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection

<script>
    function multiply(element) 
    {
        var form = element.form;
        form.total_price.value = element.value * form.price.value;
    }
</script>
