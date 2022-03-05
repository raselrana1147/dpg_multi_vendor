<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\OrderCommission;
use App\Models\Admin\CommissionDetail;



class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function order_commission_datatable()
    {
       $datas=OrderCommission::orderBy('id','DESC')->get();
      
        return DataTables::of($datas)
        ->editColumn('sub_total',function(OrderCommission $data){
        	 return currency().number_format($data->sub_total,2);
        })
        ->editColumn('order_number',function(OrderCommission $data){
        	 return $data->order->order_number;
        })
        ->editColumn('seller_amount',function(OrderCommission $data){
        	 return currency().number_format($data->seller_amount,2);
        })
        ->editColumn('company_will_get',function(OrderCommission $data){
        	 return currency().number_format($data->company_will_get,2);
        })
       ->rawColumns(['order_number'])
        ->make(true);
    }

    public function order_commission()
    {
    	return view('admin.commission.order_commission');
    }

    public function order_history_datatable()
    {
       $datas=CommissionDetail::orderBy('id','DESC')->get();
      
        return DataTables::of($datas)
        ->editColumn('order_number',function(CommissionDetail $data){

        	 return '<a href="'.route('admin.order_detail',$data->order_id).'" target="_blank">'.$data->order->order_number.'</a>';
        })
        ->editColumn('product',function(CommissionDetail $data){
        	
        	  return '<a href="'.route('product.detail',$data->product_id).'" target="_blank">'.$data->product->name.'</a>';
        	  
        })
        ->editColumn('seller',function(CommissionDetail $data){
        	 return $data->seller->full_name;
        })
        ->editColumn('seller_amount',function(CommissionDetail $data){
        	 return currency().number_format($data->seller_amount,2);
        })
        ->editColumn('unit_commission',function(CommissionDetail $data){
        	 return currency().number_format($data->unit_commission,2);
        })
        ->editColumn('total_commission',function(CommissionDetail $data){
        	 return currency().number_format($data->total_commission,2);
        })
       ->rawColumns(['order_number','product'])
        ->make(true);
    }


    public function order_commission_history()
    {
    	return view('admin.commission.commission_history');
    }

    
}
