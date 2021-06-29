@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Create new Product
            </h1>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="/products" method="POST">
            @csrf
        <div class="form-group">
            <input
                type="hidden"
                class="form-control"
                value={{$id}}
                name="subcategory_id">
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="title"
                placeholder="Product title...">
            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description"  placeholder="Product description..."></textarea>
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="number"
                class="form-control"
                name="price"
                placeholder="Product price...">
            @if($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="form-group">  
            <input
                type="text"
                class="form-control"
                name="brand"
                placeholder="Brand name...">
            @if($errors->has('brand'))
                <span class="text-danger">{{ $errors->first('brand') }}</span>
            @endif
        </div>
        <div class="form-group">   
            <input
                type="number"
                class="form-control"
                name="stock"
                placeholder="Stock...">
            @if($errors->has('stock'))
                <span class="text-danger">{{ $errors->first('stock') }}</span>
            @endif
        </div>
            <div class="form-group">   
            <input
                type="text"
                class="form-control"
                name="image"
                placeholder="Image URL...">
            @if($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>
            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </div>
        </form>
        <a href="/categories"> Go back to categories</a>
    </div>
@endsection    
