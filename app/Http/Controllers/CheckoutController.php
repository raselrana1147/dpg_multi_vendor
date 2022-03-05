<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;

class CheckoutController extends Controller
{
    
	public function checkout()
	{
		$carts=Cart::carts();
		$total_price=Cart::total_price();
		$grand_total=$total_price+shipping_charge()+tax();

		if (Auth::check() && (Auth::user()->user_type=="customer")) 
		{
			if (count($carts)>0) {
				return view('user.checkout',compact('carts','total_price','grand_total'));
			}else{
				$notification=array(
				 'message'=>'Please add product inside your cart',
				 'alert-type'=>'info',
				 );
				return redirect()->back()->with($notification);
			}
			
			
		}else{
			$notification=array(
			 'message'=>'Please Login first !!',
			 'alert-type'=>'info',
			  'login'=>'fource'
			 );
			return redirect()->back()->with($notification);
		}
	}


	public function submit_checkout (Request $request)
	{
		//dd($request->all());

			$lname         =$request->lname;
			$fname         =$request->fname;
			$phone         =$request->phone;
			$email         =$request->email;
			$country       =$request->country;
			$city          =$request->city;
			$postcode      =$request->postcode;
			$address       =$request->address;
			$order_note    =$request->order_note;
			$payment_method=$request->payment_method;
		    $user_id=Auth::user()->id;

		

			$order_number=rand(10000,99999);
			$carts       =Cart::carts();
			$total_price      =Cart::total_price();
			$total_item   =Cart::total_item();
			$tax         =tax();
			$shipping_charge=shipping_charge();
			$grand_total =$total_price+$tax+$shipping_charge;

			$shipping_detail=array(
				'lname'=>$lname,
				'fname'=>$fname,
				'phone'=>$phone,
				'email'=>$email,
				'country'=>$country,
				'city'=>$city,
				'postcode'=>$postcode,
				'address'=>$address
			);



			//inser Order table
			$order                =new Order();
			$order->quantity      =$total_item;
		    $order->shipping_charge =$shipping_charge;
			$order->sub_total     =$total_price;
			$order->tax           =$tax;
			$order->grand_total   =$grand_total;
			$order->user_id       =$user_id;
			$order->order_number  =$order_number;
			$order->payment_method=$payment_method;
			$order->shipping_detail=json_encode($shipping_detail);


			if (!empty($request->order_note)) {
				$order->order_note=$request->order_note;
			}
			 $order->save();


			foreach ($carts as $cart) {
				//insert into Order Details
				$order_detail                  =new OrderDetail();
				$order_detail->order_id        =$order->id;
				$order_detail->product_id      =$cart->product_id;
				$order_detail->size_id      =$cart->size_id;
				$order_detail->color_id      =$cart->color_id;
				$order_detail->product_quantity=$cart->quantity;
				$order_detail->seller_id        =$cart->seller_id;
				$order_detail->save();

			}

			

		  // insert data into billing details table
			// $billing=new BillingDetail();
			// $billing->order_id=$order->id;
			// $billing->user_id=$user_id;
			// $billing->customer_name=$customer_name;
			// $billing->customer_email=$customer_email;
			// $billing->customer_phone=$customer_phone;
			// $billing->customer_address=$customer_address;
			// $billing->save();

			foreach (Cart::carts() as $c) {
				$c->delete();
			}
			$orders=OrderDetail::where('order_id',$order->id)->get();

			return view('user.checkout_success',compact('orders','order'));
	}

	public function checkout_success()
	{
		return view('user.checkout_success');
	}


}
