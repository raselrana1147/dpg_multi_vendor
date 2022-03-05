<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('admin');
     }


    public function seller_datatable()
    {
       $datas=User::where('user_type','=','seller')->orderBy('id','DESC')->get();
      
        return DataTables::of($datas)

         ->editColumn('image',function(User $data){
              $url=$data->image ? asset("assets/backend/image/profile/seller/small/".$data->profile_image_url) 
              :asset("assets/backend/image/".default_image());
              return '<img src='.$url.' border="0" style="width:100px;height:100px; border-radius:50%" class="img-rounded" />';         
          })
          ->editColumn('joining',function(User $data){
             return date("d F Y",strtotime($data->created_at));
          })
        ->editColumn('action',function(User $data){
                 return '
                   <a href="" class="btn btn-dark btn-sm">
                     	Detail
                  </a>';
        })
       ->rawColumns(['image','joining','action'])
        ->make(true);   
    }


     public function customer_datatable()
    {
       $datas=User::where('user_type','=','customer')->orderBy('id','DESC')->get();
      
        return DataTables::of($datas)

         ->editColumn('image',function(User $data){
              $url=$data->image ? asset("assets/backend/image/profile/seller/small/".$data->profile_image_url) 
              :asset("assets/backend/image/".default_image());
              return '<img src='.$url.' border="0" style="width:100px;height:100px; border-radius:50%" class="img-rounded" />';         
          })
          ->editColumn('joining',function(User $data){
             return date("d F Y",strtotime($data->created_at));
          })
        ->editColumn('action',function(User $data){
                 return '
                   <a href="" class="btn btn-dark btn-sm">
                      Detail
                  </a>';
        })
       ->rawColumns(['image','joining','action'])
        ->make(true);   
    }

     public function seller_index()
     {
     
     	return view('admin.user.seller_index');
     }


     public function customer_index()
     {
        return view('admin.user.customer_index');
     }


}
