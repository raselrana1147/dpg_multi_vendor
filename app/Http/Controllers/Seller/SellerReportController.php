<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\OrderDetail;

class SellerReportController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('seller');
    }


    public function daily_report()
    {

    	    $seller=Auth::user();

    	    $dateS = new Carbon();
    	    $start=$dateS->format('Y-m-d')." 00:00:01";
    	    $to=$dateS->format('Y-m-d')." 23:59:59";

    	    $my_orders=[];
    	    $total_sale=0;
    	    $unit_total_price=0;
    	    $total_seller_order=0;
    	    $total_seller_quantity=0;
    	    $company_commission=10;
    	    $provided_commission=0;
    	    $total_earning=0;

    	    // $order_details = DB::table('order_details')
    	    // ->select('seller_id')
    	    // ->where('seller_id','=',$seller->id)
    	    // ->where('seller_id','!=',null)
    	    // ->orderBy('seller_id','desc')
    	    // ->groupBy('seller_id')->get();
         
    	    //  $seller_id = $order_details[0];

        
    	    $orders = DB::table('orders')
    	        ->select(
    	            'orders.*',
    	            'order_details.seller_id as seller_id',
    	            'order_details.order_id as order_id'
    	        )
    	        ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	        ->where('order_details.seller_id', $seller->id)
    	        ->whereBetween('orders.created_at', [$start,$to])
    	        ->groupBy('order_id')
    	        ->get();

    	    foreach ($orders as $order){
    	        $order_details=OrderDetail::where('order_id',$order->id)->where('seller_id',$seller->id)->get();

    	        if (count($order_details)>0){
    	            if ($order_details[0]->order_id==$order->id){
    	                $unit_total_commission=0;

    	                foreach ($order_details as $order_detail){
    	                 
    	                        $product_price=$order_detail->product->current_price;
    	                        $unit_total_price=$product_price*$order_detail->product_quantity;

    	                        // company commission
    	                        $unit_comp_commission=($product_price*$company_commission)/100;
    	                        $total_comp_commission=$unit_comp_commission*$order_detail->product_quantity;
    	                        $provided_commission+=$total_comp_commission;
    	                    

    	                    
    	                    $total_seller_quantity+=$order_detail->product_quantity;

    	                }

    	                $custom_order=array(
    	                    'id'=>$order->id,
    	                    'order_number'=>$order->order_number,
    	                    'unit_total_price'=>$unit_total_price,
    	                    'status'=>$order->status,
    	                    'created_at'=>$order->created_at
    	                );
    	                array_push($my_orders,$custom_order);

    	                $total_sale+=$unit_total_price;
    	                $total_seller_order+=1;
    	            }
    	        }
    	    }

    	    $total_earning=$total_sale-$provided_commission;

    	    
    	//return $my_orders;
    	    $data=array(
    	        'my_orders'=>$my_orders,
    	        'total_seller_order'=>$total_seller_order,
    	        'total_sale'=>$total_sale,
    	        'total_seller_quantity'=>$total_seller_quantity,
    	        'provided_commission'=>$provided_commission,
    	        'total_earning'=>$total_earning
    	    );
    	    
    	     
    	    return view('seller.report.daily_report',compact('my_orders','total_seller_order','total_sale','total_seller_quantity','provided_commission','total_earning'));
          


    }


    public function weekly_report()
    {

    	    $dateS =Carbon::today();
    	    $start=$dateS->format('Y-m-d');
    	    $to=$dateS->subDays(7)->format('Y-m-d');

    	    
    	    $seller=Auth::user();

    	  //  return $to;

    	       $my_orders=[];
    	       $total_sale=0;
    	       $unit_total_price=0;
    	       $total_seller_order=0;
    	       $total_seller_quantity=0;
    	       $company_commission=10;
    	       $provided_commission=0;
    	       $total_earning=0;


    	       // $order_details = DB::table('order_details')
    	       // ->select('seller_id')
    	       // ->where('seller_id','=',$seller->id)
    	       // ->where('seller_id','!=',null)
    	       // ->orderBy('seller_id','desc')
    	       // ->groupBy('seller_id')->get();

    	       // $seller_id = $order_details[0];

    	       $orders = DB::table('orders')
    	           ->select(
    	               'orders.*',
    	               'order_details.seller_id as seller_id',
    	               'order_details.order_id as order_id'
    	           )
    	           ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	           ->where('order_details.seller_id', $seller->id)
    	           ->whereBetween('orders.created_at', [$to,$start])
    	           ->groupBy('order_id')
    	           ->get();

    	       foreach ($orders as $order){
    	           $order_details=OrderDetail::where('order_id',$order->id)->where('seller_id',$seller->id)->get();

    	           if (count($order_details)>0){
    	               if ($order_details[0]->order_id==$order->id){
    	                   $unit_total_commission=0;

    	                   foreach ($order_details as $order_detail){
    	                    
    	                           $product_price=$order_detail->product->current_price;
    	                           $unit_total_price=$product_price*$order_detail->product_quantity;

    	                           // company commission
    	                           $unit_comp_commission=($product_price*$company_commission)/100;
    	                           $total_comp_commission=$unit_comp_commission*$order_detail->product_quantity;
    	                           $provided_commission+=$total_comp_commission;
    	                       

    	                    
    	                       $total_seller_quantity+=$order_detail->product_quantity;

    	                   }

    	                   $custom_order=array(
    	                       'id'=>$order->id,
    	                       'order_number'=>$order->order_number,
    	                       'unit_total_price'=>$unit_total_price,
    	                       'status'=>$order->status,
    	                       'created_at'=>$order->created_at
    	                   );
    	                   array_push($my_orders,$custom_order);

    	                   $total_sale+=$unit_total_price;
    	                   $total_seller_order+=1;
    	               }
    	           }
    	       }

    	       $total_earning=$total_sale-$provided_commission;

    	       
    	   //return $my_orders;
    	       $data=array(
    	           'my_orders'=>$my_orders,
    	           'total_seller_order'=>$total_seller_order,
    	           'total_sale'=>$total_sale,
    	           'total_seller_quantity'=>$total_seller_quantity,
    	           'provided_commission'=>$provided_commission,
    	           'total_earning'=>$total_earning
    	       );
    	       
    	        
    	   return view('seller.report.weekly_report',compact('my_orders','total_seller_order','total_sale','total_seller_quantity','provided_commission','total_earning'));
    }

    public function monthly_report()
    {
    	  $dateS =Carbon::today();
    	  $start=$dateS->format('Y-m-d');
    	  $to=$dateS->subDays(30)->format('Y-m-d');

    	  
    	  $seller=Auth::user();

    	//  return $to;

    	     $my_orders=[];
    	     $total_sale=0;
    	     $unit_total_price=0;
    	     $total_seller_order=0;
    	     $total_seller_quantity=0;
    	     $company_commission=10;
    	     $provided_commission=0;
    	     $total_earning=0;

    	     // $order_details = DB::table('order_details')
    	     // ->select('seller_id')
    	     // ->where('seller_id','=',$seller->id)
    	     // ->where('seller_id','!=',null)
    	     // ->orderBy('seller_id','desc')
    	     // ->groupBy('seller_id')->get();

    	     // $seller_id = $order_details[0];

    	     $orders = DB::table('orders')
    	         ->select(
    	             'orders.*',
    	             'order_details.seller_id as seller_id',
    	             'order_details.order_id as order_id'
    	         )
    	         ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	         ->where('order_details.seller_id', $seller->id)
    	         ->whereBetween('orders.created_at', [$to,$start])
    	         ->groupBy('order_id')
    	         ->get();

    	     foreach ($orders as $order){
    	         $order_details=OrderDetail::where('order_id',$order->id)->where('seller_id',$seller->id)->get();

    	         if (count($order_details)>0){
    	             if ($order_details[0]->order_id==$order->id){
    	                 $unit_total_commission=0;

    	                 foreach ($order_details as $order_detail){
    	                  
    	                         $product_price=$order_detail->product->current_price;
    	                         $unit_total_price=$product_price*$order_detail->product_quantity;

    	                         // company commission
    	                         $unit_comp_commission=($product_price*$company_commission)/100;
    	                         $total_comp_commission=$unit_comp_commission*$order_detail->product_quantity;
    	                         $provided_commission+=$total_comp_commission;
    	                     

    	                    
    	                     $total_seller_quantity+=$order_detail->product_quantity;

    	                 }

    	                 $custom_order=array(
    	                     'id'=>$order->id,
    	                     'order_number'=>$order->order_number,
    	                     'unit_total_price'=>$unit_total_price,
    	                     'status'=>$order->status,
    	                     'created_at'=>$order->created_at
    	                 );
    	                 array_push($my_orders,$custom_order);

    	                 $total_sale+=$unit_total_price;
    	                 $total_seller_order+=1;
    	             }
    	         }
    	     }

    	     $total_earning=$total_sale-$provided_commission;

    	     
    	 //return $my_orders;
    	     $data=array(
    	         'my_orders'=>$my_orders,
    	         'total_seller_order'=>$total_seller_order,
    	         'total_sale'=>$total_sale,
    	         'total_seller_quantity'=>$total_seller_quantity,
    	         'provided_commission'=>$provided_commission,
    	         'total_earning'=>$total_earning
    	     );
    	     
    	      
    	 return view('seller.report.monthly_report',compact('my_orders','total_seller_order','total_sale','total_seller_quantity','provided_commission','total_earning'));
    }


    public function custom_report()
    {
    	  $my_orders=null;
    	  return view('seller.report.custom_report',compact('my_orders'));
    }


    public function generate_report(Request $request)
    {

    	$this->validate($request,[
    	    'start_date'=>'required',
    	    'end_date'=>'required'
    	]);

    	$seller=Auth::user();
    	$start=date('Y-m-d',strtotime($request->start_date));
    	$to=date('Y-m-d',strtotime($request->end_date));

    	    $my_orders=[];
    	    $total_sale=0;
    	    $unit_total_price=0;
    	    $total_seller_order=0;
    	    $total_seller_quantity=0;
    	    $company_commission=10;
    	    $provided_commission=0;
    	    $total_earning=0;

    	    // $order_details = DB::table('order_details')
    	    // ->select('seller_id')
    	    // ->where('seller_id','=',$seller->id)
    	    // ->where('seller_id','!=',null)
    	    // ->orderBy('seller_id','desc')
    	    // ->groupBy('seller_id')->get();

    	    // $seller_id = $order_details[0];

    	    $orders = DB::table('orders')
    	        ->select(
    	            'orders.*',
    	            'order_details.seller_id as seller_id',
    	            'order_details.order_id as order_id'
    	        )
    	        ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	        ->where('order_details.seller_id', $seller->id)
    	        ->whereBetween('orders.created_at', [$to,$start])
    	        ->groupBy('order_id')
    	        ->get();

    	    foreach ($orders as $order){
    	        $order_details=OrderDetail::where('order_id',$order->id)->where('seller_id',$seller->id)->get();

    	        if (count($order_details)>0){
    	            if ($order_details[0]->order_id==$order->id){
    	                $unit_total_commission=0;

    	                foreach ($order_details as $order_detail){
    	                 
    	                        $product_price=$order_detail->product->current_price;
    	                        $unit_total_price=$product_price*$order_detail->product_quantity;

    	                        // company commission
    	                        $unit_comp_commission=($product_price*$company_commission)/100;
    	                        $total_comp_commission=$unit_comp_commission*$order_detail->product_quantity;
    	                        $provided_commission+=$total_comp_commission;
    	                    

    	                    
    	                    $total_seller_quantity+=$order_detail->product_quantity;

    	                }

    	                $custom_order=array(
    	                    'id'=>$order->id,
    	                    'order_number'=>$order->order_number,
    	                    'unit_total_price'=>$unit_total_price,
    	                    'status'=>$order->status,
    	                    'created_at'=>$order->created_at
    	                );
    	                array_push($my_orders,$custom_order);

    	                $total_sale+=$unit_total_price;
    	                $total_seller_order+=1;
    	            }
    	        }
    	    }

    	    $total_earning=$total_sale-$provided_commission;
    	    
    	return view('seller.report.custom_report',compact('my_orders','total_seller_order','total_sale','total_seller_quantity','provided_commission','total_earning'));

    }
}
