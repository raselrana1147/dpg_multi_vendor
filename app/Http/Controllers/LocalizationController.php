<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    

    public function set_locale($locale)
    {
    	App::setLocale($locale);
    	Session::put('locale',$locale);
    	return redirect()->back();
    }
}
