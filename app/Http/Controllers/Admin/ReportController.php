<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function daily_report()
    {

    	$dateS = new Carbon();
    	$start=$dateS->format('Y-m-d')." 00:00:01";
    	$to=$dateS->format('Y-m-d')." 23:59:59";

    	    $orders = Order::whereBetween('created_at', [$start,$to])
    	    ->where('status','delivered')
    	    ->get();

    	    $total_pro_amount = DB::table('orders')
    	    ->where('status','delivered')
    	    ->whereBetween('created_at', [$start,$to])
    	    ->get()->sum('sub_total');

    	    $total_orders = DB::table('orders')
    	    ->where('status','delivered')
    	    ->whereBetween('created_at', [$start,$to])->count();

    	    $total_quantity = DB::table('orders')
    	    ->where('status','delivered')
    	    ->whereBetween('created_at', [$start,$to])
    	    ->get()->sum('quantity');


    	    $total_company_will_get=0;
    	    $total_seller_earning=0;
    	    foreach ($orders as $order){
    	        $order_items     =$order->items;
    	        $seller_amount   =0;
    	        $company_will_get=0;
    	        $total_amount    =0;
    	        if (!is_null($order)) {

    	            foreach ($order_items as  $item) {

    	                $product_price=$item->product->current_price;
    	                if ($item->seller_id !=null) {
    	                    $comp_comission=10;
    	                        $current_price=$product_price;
    	                        $total_amount+=$current_price*$item->product_quantity;
    	                        $unit_comp_commission =($current_price*$comp_comission)/100;
    	                        $total_comp_commission=$unit_comp_commission*$item->product_quantity;
    	                        $company_will_get+=$total_comp_commission;
    	                    }
    	                }
    	            }
    	        
    	        $total_company_will_get+=$company_will_get;
    	        $total_seller_earning+=$total_amount;
    	    }
    	$total_earning=$total_pro_amount-$total_company_will_get;
    	     
    	return view('admin.report.daily_report',compact('orders','total_pro_amount','total_orders','total_quantity','total_company_will_get','total_seller_earning','total_earning'));
    }


    public function weekly_report()
    {

    	    $dateS =Carbon::today();
    	    $start=$dateS->format('Y-m-d')." 23:59:59";
    	    $to=$dateS->subDays(7)->format('Y-m-d')." 00:00:01";

    	  //  return $to;

    	    $orders = Order::whereBetween('created_at', [$to,$start])
    	    ->where('status','delivered')
    	    ->get();

    	    $total_pro_amount = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])
    	        ->get()->sum('sub_total');

    	    $total_orders = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])->count();

    	    $total_quantity = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])
    	        ->get()->sum('quantity');



    	    $total_company_will_get=0;
    	    $total_seller_earning=0;

    	    foreach ($orders as $order){
    	        $order_items     =$order->items;
    	        $seller_amount   =0;
    	        $company_will_get=0;
    	        $total_amount    =0;
    	        if (!is_null($order)) {

    	            foreach ($order_items as  $item) {

    	                $product_price=$item->product->current_price;
    	                if ($item->seller_id !=null) {
    	                       $comp_comission=10;
    	                        $current_price=$product_price;
    	                        $total_amount+=$current_price*$item->product_quantity;
    	                        $unit_comp_commission =($current_price*$comp_comission)/100;
    	                        $total_comp_commission=$unit_comp_commission*$item->product_quantity;
    	                        $company_will_get+=$total_comp_commission;
    	                    }
    	                }
    	            }
    	        
    	        $total_company_will_get+=$company_will_get;
    	        $total_seller_earning+=$total_amount;
    	    }

    	    $total_earning=$total_pro_amount-$total_company_will_get;
    	

    	return view('admin.report.weekly_report',compact('orders','total_pro_amount','total_orders','total_quantity','total_company_will_get','total_seller_earning','total_earning'));
    }

    public function monthly_report()
    {

    	    $dateS =Carbon::today();
    	    $start=$dateS->format('Y-m-d')." 23:59:59";
    	    $to=$dateS->subDays(30)->format('Y-m-d')." 00:00:01";

    	  //  return $to;

    	    $orders = Order::whereBetween('created_at', [$to,$start])
    	    ->where('status','delivered')
    	    ->get();

    	   

    	    $total_pro_amount = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])
    	        ->get()->sum('sub_total');

    	    $total_orders = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])->count();

    	    $total_quantity = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])
    	        ->get()->sum('quantity');



    	    $total_company_will_get=0;
    	    $total_seller_earning=0;

    	    foreach ($orders as $order){
    	        $order_items     =$order->items;
    	        $seller_amount   =0;
    	        $company_will_get=0;
    	        $total_amount    =0;
    	        if (!is_null($order)) {

    	            foreach ($order_items as  $item) {

    	                $product_price=$item->product->current_price;
    	                if ($item->seller_id !=null) {
    	                       $comp_comission=10;
    	                        $current_price=$product_price;
    	                        $total_amount+=$current_price*$item->product_quantity;
    	                        $unit_comp_commission =($current_price*$comp_comission)/100;
    	                        $total_comp_commission=$unit_comp_commission*$item->product_quantity;
    	                        $company_will_get+=$total_comp_commission;
    	                    }
    	                }
    	            }
    	        
    	        $total_company_will_get+=$company_will_get;
    	        $total_seller_earning+=$total_amount;
    	    }

    	    $total_earning=$total_pro_amount-$total_company_will_get;
    	

    	return view('admin.report.monthly_report',compact('orders','total_pro_amount','total_orders','total_quantity','total_company_will_get','total_seller_earning','total_earning'));
    }


    public function custom_report()
    {
    	  $orders=null;
    	  return view('admin.report.custom_report',compact('orders'));
    }


    public function generate_report(Request $request)
    {

    	$this->validate($request,[
    	    'start_date'=>'required',
    	    'end_date'=>'required'
    	]);

    
    	$start=date('Y-m-d',strtotime($request->start_date));
    	$to=date('Y-m-d',strtotime($request->end_date));

    	    $orders = Order::whereBetween('created_at', [$to,$start])
    	    ->where('status','delivered')
    	    ->get();

    	    $total_pro_amount = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])
    	        ->get()->sum('sub_total');

    	    $total_orders = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])->count();

    	    $total_quantity = DB::table('orders')
    	        ->where('status','delivered')
    	        ->whereBetween('created_at', [$to,$start])
    	        ->get()->sum('quantity');



    	    $total_company_will_get=0;
    	    $total_seller_earning=0;

    	    foreach ($orders as $order){
    	        $order_items     =$order->items;
    	        $seller_amount   =0;
    	        $company_will_get=0;
    	        $total_amount    =0;
    	        if (!is_null($order)) {

    	            foreach ($order_items as  $item) {

    	                $product_price=$item->product->current_price;
    	                if ($item->seller_id !=null) {
    	                       $comp_comission=10;
    	                        $current_price=$product_price;
    	                        $total_amount+=$current_price*$item->product_quantity;
    	                        $unit_comp_commission =($current_price*$comp_comission)/100;
    	                        $total_comp_commission=$unit_comp_commission*$item->product_quantity;
    	                        $company_will_get+=$total_comp_commission;
    	                    }
    	                }
    	            }
    	        
    	        $total_company_will_get+=$company_will_get;
    	        $total_seller_earning+=$total_amount;
    	    }

    	    $total_earning=$total_pro_amount-$total_company_will_get;
    	
    	  return view('admin.report.custom_report',compact('orders','total_pro_amount','total_orders','total_quantity','total_company_will_get','total_seller_earning','total_earning'));

    }


}
