<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Seller\Product;
use Yajra\DataTables\Facades\DataTables;

class ManageProductController extends Controller
{
    
	public function __construct()
	{
	    $this->middleware('auth');
	    $this->middleware('admin');
	}


	public function datatable()
	{
		$datas=Product::orderBy('id','DESC')->get();
		
		 return DataTables::of($datas)

		  ->editColumn('thumbnail',function(Product $data){
		           $url=$data->thumbnail ? asset("assets/backend/image/product/small/".$data->thumbnail) 
		           :asset("assets/backend/image/".default_image());
		           return '<img src='.$url.' border="0" width="120" height="50" class="img-rounded" />';         
		   })
		  ->editColumn('owner',function(Product $data){
		           return '<div>
		           		<strong>Owner Info</strong>
		           		<p>'.'Name: '.$data->owner->first_name.' '.$data->owner->last_name.'</p>
		           		<p>'.'Shop Name: '.$data->owner->shop_name.'</p>
		           </div>';         
		   })
		  ->editColumn('name',function(Product $data){
		           return '<a target="_blank" href="'.route('product.detail',$data->slug).'">
		            '.$data->name.'
		           </a>';         
		   }) 
		 ->editColumn('action',function(Product $data){
		          return '
		            <a target="_blank" href="'.route('product.detail',$data->slug).'" class="btn btn-dark btn-sm">
		            <i class="fa fa-eye"></i>
		           </a>';
		 })
		->rawColumns(['thumbnail','owner','name','action'])
		 ->make(true);
	}

	public function index()
	{
		return view('admin.product.index');
	}

}
