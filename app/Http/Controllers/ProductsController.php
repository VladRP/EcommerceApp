<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cartitem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Gate::allows('admin-only', auth()->user())){

            return view('products.create')->with('id', $id);
        }

        return abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $request->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'price' => 'required',
        'brand' => 'required|max:255',
        'stock' => 'required',
        'image' => 'required',
        ]);
        $product = Product::create([
            'subcategory_id' => $request->input('subcategory_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'brand' => $request->input('brand'),
            'stock' => $request->input('stock'),
            'image' => $request->input('image'),
        ]);

        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if(Gate::allows('admin-only', auth()->user())){

            return view('products.edit')->with('product', $product);
        }

        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required',
            'brand' => 'required|max:255',
            'stock' => 'required',
            'image' => 'required'
        ]);
        $product = Product::where('id', $id)->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'brand' => $request->input('brand'),
                'stock' => $request->input('stock'),
                'image' => $request->input('image'),
        ]);

        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = Product::where('title', 'LIKE', "%{$search}%")
        ->orWhere('description', 'like', "%{$search}%")
        ->orWhere('brand', 'like', "%{$search}%")
        ->get();
   
        return view('products.search')->with('results', $results);
    }

    public function addStock(Request $request, $id)
    {
        if(Gate::allows('admin-only', auth()->user())){
            $product = Product::find($id);
            $product->stock = $request->input('added_stock');
            $product->save();

            return redirect()->back();
        }
        
        return abort(403);
    }   
}
