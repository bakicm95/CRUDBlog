<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraFlash;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       // Check if User have Role, if not, make him Author.
       if(count(auth()->user()->roles) == 0){
            auth()->user()->syncRoles(explode(',', 4));
       }

        LaraFlash::add()->content('Hello User')->priority(1)->type('Info');
        return view('home');
    }
}
