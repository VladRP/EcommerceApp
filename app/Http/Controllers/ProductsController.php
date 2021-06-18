<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('products.create')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        Session::put('id', 4);

        $product = Product::create([
            'subcategory_id' => $request->input('subcategory_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'in_stock' => $request->input('in_stock'),
            'brand' => $request->input('brand'),
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        
        
        $search = $request->input('search');
        $results = Product::where('title', 'LIKE', "%{$search}%")->orWhere('description', 'like', "%{$search}%")->get();
        //dd($results);
        //dd(Session::get('products'));
        //dd(Session::get('id'));
       
        return view('products.search')->with('results', $results);
    }

    public function addToCart(Request $request, $id){

        $products = Session::get('products');
       
        if($products!=null){
            $product = Product::find($id)->toArray();
            
            Session::push('products', $product);}  
        else{
            $product = Product::find($id)->toArray();
            Session::push('products', $product);
        }
        
        //return redirect('home');
    }

    //public function deleteFromCart($id){
       // $product = Product::find($id);
        //Session::get('products');

    //}
}
