<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
   

    public  function showLoginForm()
    {
    	if(Auth::check() && Auth::user()->user_type=="customer"){
            return redirect()->route('home.page');
      }
      	return view('auth.login');

    }
}
