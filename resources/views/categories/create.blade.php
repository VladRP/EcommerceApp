@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Categories
            </h1>
        </div>
    </div>
    <div class="flex justify-center pt-20">
        <form action="/categories" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input
                    type="text"
                    class="form-control"
                    name="title"
                    placeholder="Category title...">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Descripition</label>
                <textarea
                    rows="3"
                    class="form-control"
                    name="description"
                    placeholder="Category description..."></textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Image</label>
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
@endsection
