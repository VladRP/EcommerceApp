<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showUserPage()
    {
        return view('homeuser');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'country' => 'required|max:255|min:3',
            'city' => 'required|max:255|min:3',
            'address' => 'required|max:255'
        ]);
        $user = Auth::user();
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back();
    }

    public function aboutUs()
    {
        
        return view('private');
    }
}
 