@extends('layouts.app')

@section('content')

    <form action="/products" method="GET">
        <input type="text" name="search" required/>
        <button type="submit">Search</button>
    </form>

    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Categories
            </h1>
        </div>
    </div>

    <div>
        <a href="categories/create">
            Create Category
        </a>
    </div>

    <div class="w-5/6 py-10">
        @foreach($categories as $category)

        <div>
            <a href="categories/{{ $category->id}}/edit">
                Edit
            </a>
        </div>
            <div class="m-auto">
                <a href="categories/{{ $category->id}}">
                    <h2 class="text-gray-700 text-5xl">
                        {{$category->title}}
                    </h2>
                </a>

            <p class="text-lg text-gray-700 py-6">
                {{$category->description}}
            </p>
            </div>

            <form action="/categories/{{ $category->id }}" method="POST">
                @csrf
                @method('delete')
                <button 
                    type="submit"
                    class="border-b-2 pb-2 border-dotted italic text-red-500">
                        Delete
                </button>

        @endforeach
    </div>

@endsection            


