<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use App\Models\Seller\Product;
use App\Models\Review;

class ShopController extends Controller
{
    


    public function product_shop()
    {
    	$brands=Brand::latest()->get();
    	$products=Product::latest()->paginate(15);
    	$recommendeds=Product::inRandomOrder()->limit(15)->get();
    	return view('user.pages.product_shop',compact('brands',"products","recommendeds"));
    }
}
