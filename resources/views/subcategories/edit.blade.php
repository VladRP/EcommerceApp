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
            <div class="block">
                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="title"
                    value="{{ $subcategory->title }}">

                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="description"
                    value="{{ $subcategory->description }}">

                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection     