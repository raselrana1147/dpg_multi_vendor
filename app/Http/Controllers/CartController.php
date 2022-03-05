<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller\Stock;
use App\Models\Cart;
use App\Models\Seller\Product;

class CartController extends Controller
{
    


    public function add_to_cart(Request $request)
    {
    	//dd($request->all());

    	if (empty($request->color_id) || empty($request->size_id) || empty($request->quantity)) {
    		 $notification=['status'=>'200', 'type'=>'error','message'=>trans('title.something_wrong')];
    	}else
    	{

	    	if (Auth::check() && (Auth::user()->user_type == 'customer')) 
	    	{
	    		$cart=Cart::where('product_id','=',$request->product_id)
	    		->where('color_id',$request->color_id)
	    		->where('size_id',$request->size_id)
	    		->where('user_id',Auth::user()->id)->first();
	    	}else{
	    	   	
			   $cart=Cart::where('product_id','=',$request->product_id)
			   ->where('color_id',$request->color_id)
	    	   ->where('size_id',$request->size_id)
			   ->where('ip_address',$request->ip())->first();
	          }
	          if (is_null($cart)) {
	          	$product=Product::findOrFail($request->product_id);
	          	$cart            =new Cart();
	          	$cart->product_id=$request->product_id;
	          	$cart->size_id   =$request->size_id;
	          	$cart->color_id  =$request->color_id;
	          	$cart->quantity  =$request->quantity;
	          	$cart->seller_id =$product->seller_id;
	          	if (Auth::check()) 
	          	{
	          		$cart->user_id=Auth::user()->id;
	          	}else
	          	{
	          		$cart->ip_address=$request->ip();
	          	}
	          	$cart->save();
	          }else
	          {
	          	$cart->increment('quantity');
	          }

	           $total_item=Cart::total_item();
             $total_price=Cart::total_price();
	           $cart_items=$this->cart_items();
	          
	            $notification=['status'=>'200', 'type'=>'success','message'=>trans('title.item_added'),'total_item'=>$total_item,'carts'=>$cart_items,'total_price'=>$total_price];
        }

         echo json_encode($notification);
    }


    public  function update_cart(Request $request)
    {
      
      //dd($request->all());
      $check_stock=Stock::where('product_id',$request->product_id)
      ->where('size_id',$request->size_id)
      ->where('color_id',$request->color_id)
      ->first();

      //return $check_stock;
      
        if ($request->quantity>$check_stock->quantity) 
        {
          $notification=['status'=>'200', 'error'=>'error','message'=>trans('title.out_of_stock')];
          
        }else{
          $cart=Cart::findOrFail($request->cart_id);
          $cart->quantity=$request->quantity;
          $cart->save();

          $each_cart_price=number_format($cart->quantity*$cart->product->current_price,2);
          $notification=['status'=>'200', 'type'=>'success','message'=>trans('title.item_updated'),'total_price'=>Cart::total_price(),'grand_total'=>$this->grand_total(),'each_cart_price'=>$each_cart_price];
        }
      
      echo json_encode($notification);

    }



     public function grand_total()
    {
    	$total_price=Cart::total_price();
    	$grand_total=$total_price+shipping_charge()+tax();
    	return $grand_total;
    }


      public function cart_items()
    {
    	   $cart_items=Cart::carts();
    	   $total_price=Cart::total_price();
           $setProduct='';
       	    foreach ($cart_items as $cart) 
       	    {
                  $setProduct.='<ul class="list-unstyled px-3 pt-3 cart-item-added">                
                                <li class="border-bottom pb-3 mb-3">
                                    <div class="">
                                        <ul class="list-unstyled row mx-n2 cart-item-added">
                                            <li class="px-2 col-auto">
                                                <img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$cart->product->thumbnail).'" alt="Image Description" style="max-width: 100px;max-height: 80px">
                                            </li>
                                            <li class="px-2 col">
                                                <h5 class="text-blue font-size-14 font-weight-bold">'.$cart->product->name.'</h5>
                                                <span class="font-size-14">'.$cart->quantity .'×'. $cart->product->current_price.'</span>
                                            </li>
                                            <li class="px-2 col-auto">
                                                <a href="javascript:void(0)" class="text-gray-90 delete_cart" cart_id="'.$cart->id.'" data-action="'. route('delete.cart').'"><i class="ec ec-close-remove"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>';
             }

                if (count($cart_items)>0) 
                {
                     $setProduct.='<div class="flex-center-between px-4 pt-2 checkout-view">
                          <a href="'.route('view.cart').'" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">'.trans('title.view_cart').'</a>
                          <a href="'.route('checkout') .'" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5">'.trans('menu.checkout').'</a>
                      </div>';
                }else
                {
                   $setProduct.='<div class="flex-center-between px-4 pt-2 checkout-view"><h4>'.trans('title.empty_cart').'<h4></div>';
                 }

           
              return $setProduct;
    }


    public function view_cart()
    {
       $carts=Cart::carts();
       $total_price=Cart::total_price();
       $grand_total=$this->grand_total();
       return view('user.view_cart',compact('carts','total_price','grand_total'));
    }

      public function delete_cart(Request $request)
      {
        
        $cart=Cart::findOrFail($request->cart_id);
        $cart->delete();
        $total_item =Cart::total_item();
        $total_price=Cart::total_price();
        $grand_total=$this->grand_total();
  
        $notification=['status'=>'200', 'type'=>'success','message'=>trans('title.item_deleted'),'total_item'=>$total_item,'carts'=>$this->cart_items(),'total_price'=>$total_price,"grand_total"=>$grand_total];

        echo json_encode($notification);
      }
}
