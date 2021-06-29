@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Update Category
            </h1>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="/categories/{{ $category->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input
                    type="text"
                    class="form-control"
                    name="title"
                    value="{{ $category->title }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <textarea type="text"
                    class="form-control"
                    name="description"
                    placeholder="{{ $category->description }}"></textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
