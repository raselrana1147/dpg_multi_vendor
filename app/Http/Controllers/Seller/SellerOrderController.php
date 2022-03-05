<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Seller\Product;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;


class SellerOrderController extends Controller
{
    
	public function __construct()
	{
	    $this->middleware('auth');
	    $this->middleware('seller');
	}


    public function datatable(){
     
        $seller=Auth::user();
        $all_orders=Order::latest()->get();
        $orders=[];
        foreach ($all_orders as $order){
            $order_details=OrderDetail::where('order_id',$order->id)->where('seller_id',$seller->id)->get();

            if (count($order_details)>0){
                if ($order_details[0]->order_id==$order->id){

                    $id=$order->id;
                    $quantity=0;
                    $grand_total=0;
                    $order_number=$order->order_number;
                    $status=$order->status;
                    $created_at=$order->created_at;
                    // calculate seller amount and quantity
                    foreach ($order_details as $order_detail){
                        $quantity+=$order_detail->product_quantity;
                        $product=Product::find($order_detail->product_id);
                        $grand_total+=$product->current_price*$order_detail->product_quantity;
                    }
                    $custom_order=array(
                        'id'=>$id,
                        'order_number'=>$order_number,
                        'grand_total'=>$grand_total,
                        'quantity'=>$quantity,
                        'status'=>$status,
                        'created_at'=>$created_at
                    );
                    array_push($orders,$custom_order);
                }
            }
        }

         return DataTables::of($orders)
         
         ->editColumn('grand_total',function($orders){
                  return currency().number_format($orders['grand_total'],2);
         })
         ->editColumn('created_at',function($orders){
                  return date("d-m-Y",strtotime($orders['created_at']));
         })
         ->editColumn('action',function($orders){
                  return '<a href="'.route('seller.order_detail',$orders['id']).'" class="btn btn-dark btn-sm">'.trans('seller.detail').'</a>';
         })
         ->rawColumns(['action'])
         ->make(true);   
    }

    public function index()
    {
    	return view('seller.order.index');
    }	

    public function order_detail($id){
        // $seller=auth()->user();
        $seller=Auth::user();
        $order_details=OrderDetail::where('order_id',$id)
            ->where('seller_id',$seller->id)->get();
        $grand_total=0;
        foreach ($order_details as $item){
            $product=Product::find($item->product_id);
                $grand_total+=$item->product_quantity*$product->current_price;
        }
    
        return view('seller.order.order_detail',compact('order_details','grand_total'));
       
    }
}
