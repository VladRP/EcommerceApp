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
            <div class="block">
                <input
                    type="hidden"
                    value={{$id}}
                    name="subcategory_id">

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

                
                <input
                    type="number"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="price"
                    placeholder="Product price...">

                
                <input
                    type="number"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="in_stock"
                    placeholder="Is in stock?...">

                
                <input
                    type="text"
                    class="block shadow-txl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="brand"
                    placeholder="Brand name...">

                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection    