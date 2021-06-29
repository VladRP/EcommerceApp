@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <a href="{{route('subcategories.show', $product->subcategory->id)}}">Go back to subcategory></a></p>
            <h1 class="text-5xl uppercase bold">
                {{$product->title}}
            </h1>
            @if(Auth::user())
                @if(Auth::user()->isAdmin == 1)
                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary">
                            Edit
                        </a>    
                        <button type="submit" class="btn btn-danger ">Delete</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img style="max-width:100%; max-height:150%" src="{{asset('storage/images/'.$product->image)}}">
        </div>
        <div class="col-6">
            <p>Average Rating: {{$product->comment->avg('rating')}}</p>
            <p>Product Brand: {{$product->brand}}</p>
            <p>{{$product->description}}<p>
            @if($product->stock>0)
                <p>In stock</p>
            @else
                <p>Sold out</p>
            @endif
        </div>
        <div class="col">
            <form method="POST" action="{{route('cartitems.addProduct', $product->id)}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="price" value="{{$product->price}}">
            <div class="form-group">
                Qnty.:<input style="width: 95px;" type="number" min="1" max="{{round($product->stock/10 + 1)}}" onchange="multiply(this)" name="quantity" value="1">
            </div>
            <div class="form-group">
                Price:<input style="width:95px" tpye="number" name="total_price" value="{{$product->price}}" readonly>{{Config::get('constants.CURRENCY')}}
            </div>
                @if($product->stock>0)
                    <button class="btn btn-primary" type="submit">Addtocart</button>
                @endif
            </form>
        </div>
    </div>
        @if(Auth::user())
            <form action="/comments" method="POST">
                @csrf
                <input type="hidden" name="product_id" value={{$product->id}}>
                <input type="hidden" name="user_id" value={{Auth::user()->id}}>
            <div class="form-group">
                <label for="rating">Rating</label>
                <input
                    type="number"
                    class="form-control"
                    name="rating"
                    min="1"
                    max="5"
                    placeholder="Rating from 1-5">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea
                    rows="3"
                    class="form-control"
                    name="message"
                    placeholder="Message..."></textarea>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
            </form>
        </div>
    @endif
    @foreach($product->comment as $comment)
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card card-white post">
                    <div class="post-heading">
                        <div class="float-left image">
                            <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
                        </div>
                        <div class="float-left meta">
                            <div class="title h5">
                                <a href="#"><b>{{$comment->user->name}}</b></a>
                                made a post.
                            </div>
                            <div>
                                <p>Rating:{{$comment->rating}}</p>
                            </div>
                            <h6 class="text-muted time">{{$comment->created_at}}</h6>
                        </div>
                    </div> 
                    <div class="post-description"> 
                        <p>{{$comment->message}}</p>
                        @if(Auth::user())
                            @if(Auth::user()->id == $comment->user_id || Auth::user()->isAdmin==1)
                                <form action="{{route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button 
                                        type="submit"
                                        class="btn btn-danger ">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
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
