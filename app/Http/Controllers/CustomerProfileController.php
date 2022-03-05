<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\File;
use Str;
use Image;

class CustomerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function dashboard()
    {

    	return view('user.profile.dashboard');
    }

    public function password()
    {
    	return view('user.profile.password');
    }

    public function change_password(Request $request)
    {
         
            $user=Auth::user();

             if (empty($request->old_password)) {
                $notification=['alert'=>'error','message'=>trans('title.enter_old_password'),'status'=>400];
             }elseif (empty($request->new_password)) {
                    $notification=['alert'=>'error','message'=>trans('title.enter_new_password'),'status'=>401];
             }elseif (empty($request->password_confirmation)) {
                  $notification=['alert'=>'error','message'=>trans('title.enter_confirm_password'),'status'=>402];
             }else{
                if (Hash::check($request->old_password,$user->password)) {
                   if (strlen($request->new_password) >=6) {
                        if ($request->new_password===$request->password_confirmation) 
                        {
                            $user->update(['password'=>Hash::make($request->new_password)]);
                             $notification=['alert'=>'error','message'=>trans('title.item_updated'),'status'=>200];
                        }else
                        {
                            $notification=['alert'=>'error','message'=>trans('title.password_confirm_match'),'status'=>405];
                        }
                     
                   }else{
                         $notification=['alert'=>'error','message'=>trans('title.password_length'),'status'=>405];
                   }
                }else{
                  $notification=['alert'=>'error','message'=>trans('title.old_password_not_match'),'status'=>403];
                }
             }
         return json_encode($notification);
    }

    public function order_list()
    {
        $orders=Order::where('user_id',Auth::user()->id)->get();
        return view('user.profile.order',compact('orders'));
    }

    public function order_track()
    {
         return view('user.profile.order_track');
    }

    public function profile()
    {
         return view('user.profile.profile');
    }


    public function profile_update(Request $request)
    {
        $user=Auth::user();
        $this->validate($request,[
            'phone'=>'unique:users,phone,'.$user->id
        ]);

         if (empty($request->first_name)) {
             $notification=['alert'=>'error','message'=>trans('title.enter_first_name'),'status'=>405];
         }elseif (empty($request->last_name)) {
             $notification=['alert'=>'error','message'=>trans('title.enter_last_name'),'status'=>405];
         }elseif (empty($request->phone)) {
              $notification=['alert'=>'error','message'=>trans('title.enter_phone'),'status'=>405];
         }elseif(empty($request->address)){
            $notification=['alert'=>'error','message'=>trans('title.enter_address'),'status'=>405];
         }else{

            
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->phone=$request->phone;
            $user->address=$request->address;
            $user->full_name =$request->first_name." ".$request->last_name;
           if ($request->has('gender')) 
           {
              $user->gender=$request->gender;
           }
           if($request->hasFile('profile_image_url')){

                    if (File::exists(base_path('/assets/backend/image/profile/small/'.$user->profile_image_url))) 
                    {
                      File::delete(base_path('/assets/backend/image/profile/small/'.$user->profile_image_url));
                    }
                    if (File::exists(base_path('/assets/backend/image/profile/medium/'.$user->profile_image_url))) 
                    {
                      File::delete(base_path('/assets/backend/image/profile/medium/'.$user->profile_image_url));
                    }

                    if (File::exists(base_path('/assets/backend/image/profile/large/'.$user->profile_image_url)))
                     {
                       File::delete(base_path('/assets/backend/image/profile/large/'.$user->profile_image_url));
                     }

                     if (File::exists(base_path('/assets/backend/image/profile/original/'.$user->profile_image_url)))
                     {
                        File::delete(base_path('/assets/backend/image/profile/original/'.$user->profile_image_url));
                     }

                   $image=$request->profile_image_url;
                   $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
                   $original_image_path = base_path().'/assets/backend/image/profile/original/'.$image_name;
                   $large_image_path = base_path().'/assets/backend/image/profile/large/'.$image_name;
                   $medium_image_path = base_path().'/assets/backend/image/profile/medium/'.$image_name;
                   $small_image_path = base_path().'/assets/backend/image/profile/small/'.$image_name;
                   //Resize Image
                   Image::make($image)->save($original_image_path);
                   Image::make($image)->resize(1920,980)->save($large_image_path);
                   Image::make($image)->resize(1000,850)->save($medium_image_path);
                   Image::make($image)->resize(465,465)->save($small_image_path);
                   $user->profile_image_url = $image_name;  
           }

            $user->save();
            $notification=['alert'=>'success','message'=>trans('title.item_updated'),'status'=>200];
           
         }

         return json_encode($notification);
    }

    public function track_order(Request $request)
    {
       if (empty($request->order_number)) 
       {
          $notification=['alert'=>'error','message'=>trans('title.enter_order_number'),'status'=>400];
       }else{
             $order=Order::where('order_number',$request->order_number)->first();
             $display='';
              if (!is_null($order)) 
              {
                $product_item='';
                 foreach ($order->items as $item) {
                   $product_item.='<tr>
                                     <td><a href="'.route('product.detail',$item->product->slug).'"><img src="'.asset('assets/backend/image/product/small/'.$item->product->thumbnail).'" style="width: 70px;height: 60px"></td>
                                     <td>
                                      <span>'.$item->product->name.'</span><br>
                                       <span>Size: '.$item->size->size.'</span><br>
                                       <span style="background:'.$item->color->color_code.';color:'.$item->color->color_code.'">Color</span>
                                     </td>
                                      <td>'.currency().$item->product->current_price.'</td>
                                      <td>'.$item->product_quantity.'</td>
                                     <td>'.currency().$item->product_quantity*$item->product->current_price.'</td>
                                 </tr>';
                 }
                 if ($order->status=="pending") {
                   $display.='<article class="card">
                         <header class="card-header"> My Orders position </header>
                         <div class="card-body">
                              <h6>Order ID:'.$order->order_number.'</h6>
                              <h6>Total Amount: '.currency().number_format($order->grand_total,2).'</h6>
                              <h6>Shipping Charge: '.currency().number_format($order->shipping_charge,2).'</h6>
                              <h6>Tax: '.currency().number_format($order->tax,2).'</h6>
                             <div class="body-section">
                     <h3 class="heading">Ordered Items</h3>
                     <br>
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>Image</th>
                                 <th>Product</th>
                                 <th class="w-20">Price</th>
                                 <th class="w-20">Quantity</th>
                                 <th class="w-20">Total</th>
                             </tr>
                         </thead>
                         <tbody class="purchase_item">'.$product_item.'</tbody>
                     </table>
                     <br>
                     <h6 class="heading">Order Status: '.$order->status.'</h6>
                     <h6 class="heading">Payment Status: '.$order->payment_method.'</h6>
                 </div>
                             <div class="track">
                                 <div class="step active"> <span class="icon"> <i class="fas fa-redo"></i> </span> <span class="text">Pendding</span> </div>
                                 <div class="step"> <span class="icon"><i class="fas fa-reply"></i></span><span class="text"> Processing</span> </div>
                                 <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Confirmed</span> </div>
                                 <div class="step"> <span class="icon">  <i class="fa fa-truck"></i> </span> <span class="text">Delivered</span> </div>
                             </div>
                         </div>
                     </article>';
                      $notification=['alert'=>'success','message'=>$display,'status'=>200];
                 }elseif ($order->status=="processing") {
                  $display.='<article class="card">
                        <header class="card-header"> My Orders position </header>
                        <div class="card-body">
                            <h6>Order ID:'.$order->order_number.'</h6>
                            <h6>Total Amount: '.currency().number_format($order->grand_total,2).'</h6>
                            <h6>Shipping Charge: '.currency().number_format($order->shipping_charge,2).'</h6>
                            <h6>Tax: '.currency().number_format($order->tax,2).'</h6>
                            <div class="body-section">
                     <h3 class="heading">Ordered Items</h3>
                     <br>
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>Image</th>
                                 <th>Product</th>
                                 <th class="w-20">Price</th>
                                 <th class="w-20">Quantity</th>
                                 <th class="w-20">Total</th>
                             </tr>
                         </thead>
                         <tbody class="purchase_item">'.$product_item.'</tbody>
                     </table>
                     <br>
                     <h6 class="heading">Order Status: '.$order->status.'</h6>
                     <h6 class="heading">Payment Status: '.$order->payment_method.'</h6>
                 </div>
                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fas fa-redo"></i> </span> <span class="text">Pendding</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fas fa-reply"></i></span><span class="text"> Processing</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i></span> <span class="text">Confirmed</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Delivered</span> </div>
                            </div>
                        </div>
                    </article>';
                     $notification=['alert'=>'success','message'=>$display,'status'=>200];
                 }elseif ($order->status=="confirmed") {
                   $display.='<article class="card">
                         <header class="card-header"> My Orders position </header>
                         <div class="card-body">
                            <h6>Order ID:'.$order->order_number.'</h6>
                            <h6>Total Amount: '.currency().number_format($order->grand_total,2).'</h6>
                            <h6>Shipping Charge: '.currency().number_format($order->shipping_charge,2).'</h6>
                            <h6>Tax: '.currency().number_format($order->tax,2).'</h6>
                             <div class="body-section">
                     <h3 class="heading">Ordered Items</h3>
                     <br>
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>Image</th>
                                 <th>Product</th>
                                 <th class="w-20">Price</th>
                                 <th class="w-20">Quantity</th>
                                 <th class="w-20">Total</th>
                             </tr>
                         </thead>
                         <tbody class="purchase_item">'.$product_item.'</tbody>
                     </table>
                     <br>
                     <h6 class="heading">Order Status: '.$order->status.'</h6>
                     <h6 class="heading">Payment Status: '.$order->payment_method.'</h6>
                 </div>
                             <div class="track">
                                 <div class="step active"> <span class="icon"> <i class="fas fa-redo"></i> </span> <span class="text">Pendding</span> </div>
                                 <div class="step active">  <span class="icon"> <i class="fas fa-reply"></i> </span> </span> <span class="text"> Processing</span> </div>
                                 <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Confirmed</span> </div>
                                 <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Delivered</span> </div>
                             </div>
                         </div>
                     </article>';
                      $notification=['alert'=>'success','message'=>$display,'status'=>200];
                 }elseif ($order->status=="delivered") {
                  $display.='<article class="card">
                                 <header class="card-header"> My Orders position </header>
                                 <div class="card-body">
                                     <h6>Order ID:'.$order->order_number.'</h6>
                                     <h6>Total Amount: '.currency().number_format($order->grand_total,2).'</h6>
                                     <h6>Shipping Charge: '.currency().number_format($order->shipping_charge,2).'</h6>
                                     <h6>Tax: '.currency().number_format($order->tax,2).'</h6>
                                     <div class="body-section">
                     <h3 class="heading">Ordered Items</h3>
                     <br>
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>Image</th>
                                 <th>Product</th>
                                 <th class="w-20">Price</th>
                                 <th class="w-20">Quantity</th>
                                 <th class="w-20">Total</th>
                             </tr>
                         </thead>
                         <tbody class="purchase_item">'.$product_item.'</tbody>
                     </table>
                     <br>
                     <h6 class="heading">Order Status: '.$order->status.'</h6>
                     <h6 class="heading">Payment Status: '.$order->payment_method.'</h6>
                 </div>
                                     <div class="track">
                                         <div class="step active"> <span class="icon"> <i class="fas fa-redo"></i> </span> <span class="text">Pendding</span> </div>
                                         <div class="step active"> <span class="icon"> <i class="fas fa-reply"></i> </span>  <span class="text"> Processing</span> </div>

                                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Confirmed</span> </div>
                                         <div class="step active"> <span class="icon">  <i class="fa fa-truck"></i> </span> <span class="text">Delivered</span> </div>
                                     </div>
                                 </div>
                         </article>';
                          $notification=['alert'=>'success','message'=>$display,'status'=>200];
                 }elseif($order->status=="declined"){

                    $notification=['alert'=>'warning','message'=>trans('title.declined_order'),'status'=>402];
                 }
              }else{

                 $notification=['alert'=>'error','message'=>trans('title.wrong_order_number'),'status'=>401];
              }
        }
      

   return json_encode($notification);
 }
}
