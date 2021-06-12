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
            <div class="block">
                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="title"
                    placeholder="Category title...">

                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="description"
                    placeholder="Category description...">

                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection     