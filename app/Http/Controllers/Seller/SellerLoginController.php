<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SellerLoginController extends Controller
{
   
  

   public function showLoginForm()
   {
   	 if(Auth::check() && Auth::user()->user_type=="seller")
     {
            return redirect()->route('seller.dashboard');
      }
      	return view('seller.auth.login'); 
   }


   public function showRegisterForm()
    {
    	return view("auth.seller_register");
    }

    public function register(Request $request)
    {

    	 $this->validate($request,[

    	    'first_name'=> ['required', 'string', 'max:255'],
    	    'last_name' => ['required', 'string', 'max:255'],
    	    'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
    	    'phone'     => ['required', 'string', 'unique:users'],
    	    'password'  => ['required', 'string', 'min:6', 'confirmed'],
    	    'shop_name' => ['required', 'string'],
    	    'address'   => ['required'],
    	]);

    	 $user            =new User();
    	 $user->first_name=$request->first_name;
    	 $user->last_name =$request->first_name;
    	 $user->full_name =$request->first_name." ".$request->last_name;;
    	 $user->email     =$request->email;
    	 $user->phone     =$request->phone;
    	 $user->password  =Hash::make($request->password);
    	 $user->address   =$request->address;
    	 $user->shop_name =$request->shop_name;
    	 $user->user_type ="seller";
    	 $user->save();
    	 
    	 $notification=array(
    	  'message'=>'Your registration has been successfull !!',
    	  'alert-type'=>'success'
    	  );
    	 return redirect()->back()->with($notification);
    }
}
