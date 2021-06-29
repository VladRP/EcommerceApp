@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Online Shopping Center
                <h6>Choose from ours category</h6>
                <a href="{{route('products.index')}}">View our products</a>
                    @if(Auth::user())
                        @if(Auth::user()->isAdmin == 1)
                            <h3>
                                <a style="color:black" href="categories/create">
                                    Create Category
                                </a>
                            </h3>
                        @endif
                    @endif
                </h1>
            </div>
        </div>
    </div>
    <div class="w-5/6 py-10">
        <div class="container mt-100">
            @foreach($categories->chunk(4) as $chunk)
                <div class="row mt-3">
                    @foreach($chunk as $category)
                        <div class="col-md-3 col-sm-4">
                            <div class="card mb-30"><a class="card-img-tiles" style= "color:black" href="/categories/{{$category->id}}" data-abc="true">
                                <div class="inner">
                                    <img src="{{asset('storage/images/'.$category->image)}}" style="max-width:100%" alt="Category">
                                </div>
                            <div>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{$category->title}}</h4>
                                <p class="text-muted" style="text-overflow:ellipsis">{{$category->description}}</p><a href="/categories/{{$category->id}}" class="btn btn-outline-primary btn-sm" href="#" data-abc="true">View Products</a>
                                @if(Auth::user())
                                    @if(Auth::user()->isAdmin)
                                        <div>
                                            <a href="categories/{{ $category->id}}/edit" class="btn btn-primary">
                                                Edit
                                            </a>
                                        </div>
                                        <form action="/categories/{{ $category->id }}" method="POST">
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
        </div>
    @endforeach
    </div>
@endsection            
