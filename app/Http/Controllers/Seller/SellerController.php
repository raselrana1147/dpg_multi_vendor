<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller\Product;
use App\Models\Admin\CommissionDetail;

class SellerController extends Controller
{
    

   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('seller');
    }
    
    public function index()
    {

    	$seller=Auth::user();
    	$product_order_status=$this->getPicChart();
    	$getBarChart=$this->getBarChart();
    	$orders=$this->orders();
    	$total_product=Product::where('seller_id',$seller->id)->count();
    	$total_sale=$this->total_sale();
    	$pending_amount=$this->pending_amount();
    	
    	return view("seller.index",compact("product_order_status","getBarChart","orders","total_product","total_sale","pending_amount"));
    }


    private function orders()
    {
    	$seller = Auth::user();

    	// $order_details = DB::table('order_details')
    	// ->select('seller_id')
    	// ->where('seller_id','=',$seller->id)
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
    	    ->groupBy('order_id')
    	    ->take(5)
    	    ->get();

    	    return $orders;
    }



    private function getBarChart()
    {
    	$jan_amount=$this->jan_amount();
    	$feb_amount=$this->feb_amount();
    	$mar_amount=$this->mar_amount();
    	$april_amount=$this->april_amount();
    	$may_amount=$this->may_amount();
    	$june_amount=$this->june_amount();
    	$july_amount=$this->july_amount();
    	$august_amount=$this->august_amount();
    	$sept_amount=$this->sept_amount();
    	$oct_amount=$this->oct_amount();
    	$nov_amount=$this->nov_amount();
    	$dec_amount=$this->dec_amount();
    	
    	
    	$months=[
    		"jan_amount"=>$jan_amount,
    		"feb_amount"=>$feb_amount,
    		"mar_amount"=>$mar_amount,
    		"april_amount"=>$april_amount,
    		"may_amount"=>$may_amount,
    		"june_amount"=>$june_amount,
    		"july_amount"=>$july_amount,
    		"august_amount"=>$august_amount,
    		"sept_amount"=>$sept_amount,
    		"oct_amount"=>$oct_amount,
    		"nov_amount"=>$nov_amount,
    		"dec_amount"=>$dec_amount,
    	];

    	return $months;
    }


    private function dec_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '12')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function nov_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '11')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function oct_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '10')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function sept_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '09')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function august_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '08')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function july_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '07')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function june_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '06')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

     private function may_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '05')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

    private function april_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '04')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

   private function mar_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '03')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }


     private function feb_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '02')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }


    private function jan_amount()
    {
    	$seller = Auth::user();
    	$all_orders = Order::where('status','=','delivered')->whereMonth('created_at', '01')->get();

    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }

   

    private function getPicChart()
    {

    	$seller = Auth::user();

    	// $order_details = DB::table('order_details')->select('seller_id')
    	// ->where('seller_id','=',$seller->id)
    	// ->groupBy('seller_id')->get();

    	// $seller_id = $order_details[0];

    	//return $order_details;

    	$pending_orders = DB::table('orders')
    	    ->select(
    	        'orders.*',
    	        'order_details.seller_id as seller_id',
    	        'order_details.order_id as order_id'
    	    )
    	    ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	    ->where('order_details.seller_id', $seller->id)
    	    ->where('orders.status','=','pending')
    	    ->groupBy('order_id')
    	    ->get();


    	   // pie chart
    	$processing_order = DB::table('orders')
    	    ->select(
    	        'orders.*',
    	        'order_details.seller_id as seller_id',
    	        'order_details.order_id as order_id'
    	    )
    	    ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	    ->where('order_details.seller_id', $seller->id)
    	    ->where('orders.status','=','processing')
    	    ->groupBy('order_id')
    	    ->get();

    	$delivered_order = DB::table('orders')
    	    ->select(
    	        'orders.*',
    	        'order_details.seller_id as seller_id',
    	        'order_details.order_id as order_id'
    	    )
    	    ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	    ->where('order_details.seller_id', $seller->id)
    	    ->where('orders.status','=','delivered')
    	    ->groupBy('order_id')
    	    ->get();

    	$confirmed_order = DB::table('orders')
    	    ->select(
    	        'orders.*',
    	        'order_details.seller_id as seller_id',
    	        'order_details.order_id as order_id'
    	    )
    	    ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	    ->where('order_details.seller_id', $seller->id)
    	    ->where('orders.status','=','confirmed')
    	    ->groupBy('order_id')
    	    ->get();

    	$declined_order = DB::table('orders')
    	    ->select(
    	        'orders.*',
    	        'order_details.seller_id as seller_id',
    	        'order_details.order_id as order_id'
    	    )
    	    ->leftJoin('order_details','orders.id','=','order_details.order_id')
    	    ->where('order_details.seller_id', $seller->id)
    	    ->where('orders.status','=','declined')
    	    ->groupBy('order_id')
    	    ->get();

    	$product_order_status = array(
    	    "pending" => count($pending_orders),
    	    "processing" => count($processing_order),
    	    "delivered" => count($delivered_order),
    	    "confirmed" => count($confirmed_order),
    	    "declined" => count($declined_order),
    	);
    	return $product_order_status;
    	
    }

    public function total_sale()
    {
        
    	$seller=Auth::user();
    	$all_orders=Order::where('status','=','delivered')->get();
    	$orders=[];
    	$total_sale=0;
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
    	            $total_sale+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $total_sale;
    }


    public function pending_amount()
    {
        
    	$seller=Auth::user();
    	$all_orders=Order::where('status','!=','delivered')->latest()->get();
    	$orders=[];
    	$pending_amount=0;
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
    	            $pending_amount+=$grand_total;
    	        }

    	    }
    	   
    	}
    	return $pending_amount;
    }

    
}
