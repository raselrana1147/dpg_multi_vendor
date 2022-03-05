<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Seller\Product;
use App\Models\Admin\Color;
use App\Models\Admin\Size;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;

      public function product()
      {
      	return $this->belongsTo(Product::class);
      }

      public function color()
      {
    	return $this->belongsTo(Color::class);
      }

      public function size()
      {
    	return $this->belongsTo(Size::class);
      }

    public static function total_item(){
    	 

    	$cart_item=0;
    	if (Auth::check()) {

   	      	$cart_item=Cart::where('user_id',Auth::user()->id)->count();
   	        return $cart_item;
    	}else
    	{
    		$ip=\Request::ip();
   	      	$cart_item=Cart::where('ip_address',$ip)->count();
   	        return $cart_item;
    	}

   }


    public static function total_price(){
    	$total_price=0;
    	if (Auth::check()) 
    	{
   	  	 $carts=Cart::where('user_id',Auth::user()->id)->get();
   	  	 foreach($carts as $cart)
   	  	 {
   	  	 	$total_price+=$cart->product->current_price*$cart->quantity;
   	  	 }
      }else
      {
      	  $ip=\Request::ip();
	      $carts=Cart::where('ip_address',$ip)->get();	
	      foreach($carts as $cart)
	      {
	      	$total_price+=$cart->product->current_price*$cart->quantity;
	      }
      }

   	  return $total_price;
   }

    public static function carts()
    {
    	$carts=null;
	    if (Auth::check()) 
	    { 
	   	  $carts=Cart::where('user_id',Auth::user()->id)->get();
	    }
	    else
	    {
	      $ip=\Request::ip();
	      $carts=Cart::where('ip_address',$ip)->get();	     
	    }

      return $carts;
   }
}
