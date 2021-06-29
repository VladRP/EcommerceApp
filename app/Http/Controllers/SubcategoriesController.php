<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Gate;

class SubcategoriesController extends Controller
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
        if(Gate::allows('admin-only', auth()->user())){

            return view('subcategories.create')->with('id', $id);
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
            'image' => 'required|max:255',
        ]);
        //dd($request->input('category_id'));
        $subcategory = Subcategory::create([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
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
        $subcategory = Subcategory::find($id);
        
        return view('subcategories.show')->with('subcategory', $subcategory);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        if(Gate::allows('admin-only', auth()->user())){

            return view('subcategories.edit')->with('subcategory', $subcategory);
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
            'image' => 'required|max:255',
        ]);
        $subcategory = Subcategory::where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => 'required|max:255'
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
        if(Gate::allows('admin-only', auth()->user())){
            $subcategory = Subcategory::find($id);
            $subcategory->delete();

            return redirect('/categories');
        }

            return abort(403);
    }
}
