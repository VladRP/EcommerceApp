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
            <div class="block">
                <input
                    type="hidden"
                    value={{$id}}
                    name="category_id">

                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="title"
                    placeholder="Subcategory title...">

                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="description"
                    placeholder="Subcategory description...">

                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection    