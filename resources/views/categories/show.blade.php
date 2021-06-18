@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                {{$category->title}}
            </h1>
        </div>
    </div>

    <div class="w-5/6 py-10">
        @foreach($category->subCategory as $subcategory)

      
        <div class="m-auto">
            <a href="/subcategories/{{ $subcategory->id}}">
                <h2 class="text-gray-700 text-5xl">
                    {{$subcategory->title}}
                </h2>
            </a>
            <p class="text-lg text-gray-700 py-6">
                {{$subcategory->description}}
            </p>

            <a href="/subcategories/{{$subcategory->id}}/edit">
                edit
            </a>

            <form action="/subcategories/{{ $subcategory->id }}" method="POST">
                @csrf
                @method('delete')
                <button 
                    type="submit">
                        Delete
                </button>
        </div>

        @endforeach

        <a href="/subcategories/create/{{$category->id}}">
            Create new subcategory
        </a>
    </div>

@endsection            
