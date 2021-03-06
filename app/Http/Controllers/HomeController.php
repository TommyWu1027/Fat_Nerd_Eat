<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->type=="Deliver")return redirect()->route('orderList_Deliver');
        if(Auth::user()->type=="Store")return redirect()->route('storeHome');
        if(Auth::user()->type=="Customer")return redirect()->route('storeinfo');
        return view('home');
    }
}
