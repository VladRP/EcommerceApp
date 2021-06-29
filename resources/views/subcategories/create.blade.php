@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Create new Subcateogry 
            </h1>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="/subcategories" method="POST">
            @csrf
        <div class="form-group">
            <input
                type="hidden"
                value={{$id}}
                name="category_id">
            <input
                type="text"
                class="form-control"
                name="title"
                placeholder="Subcategory title...">
            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="description"
                placeholder="Subcategory description...">
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="image"
                placeholder="Image...">
            @if($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>
        
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
         </div>
        </form>
    </div>
    <a href="/categories">Go back to categories</a>
@endsection    