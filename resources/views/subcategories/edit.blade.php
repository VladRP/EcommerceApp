@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Update Subcategory
            </h1>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="/subcategories/{{ $subcategory->id }}" method="POST">
            @csrf
            @method('PUT')
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="title"
                value="{{ $subcategory->title }}">
            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="description"
                value="{{ $subcategory->description }}">
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="description"
                value="{{ $subcategory->description }}">
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="image"
                value="{{ $subcategory->image }}">
            @if($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        <div>
                <a href="/categories/{{$subcategory->category->id}}">Go back to main category </a>
        </div>
        </form>
    </div>
@endsection     