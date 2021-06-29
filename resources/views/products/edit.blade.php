@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Update Product
            </h1>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="/products/{{ $product->id }}" method="POST">
            @csrf
            @method('PUT')
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="title"
                value="{{ $product->title }}">
            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="description"
                value="{{ $product->description }}">
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="number"
                class="form-control"
                name="price"
                value="{{ $product->price }}">
            @if($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
       <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="brand"
                value="{{ $product->brand }}">
            @if($errors->has('brand'))
                <span class="text-danger">{{ $errors->first('brand') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="number"
                class="form-control"
                name="stock"
                value="{{ $product->stock }}">
            @if($errors->has('stock'))
                <span class="text-danger">{{ $errors->first('stock') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="image"
                value="{{ $product->image }}">
            @if($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
        </form>
        <a href="{{route('products.show',$product->id)}}">Go back to product</a>
    </div>
@endsection    