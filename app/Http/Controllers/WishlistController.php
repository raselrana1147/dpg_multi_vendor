<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    

    public function add_to_wishlist (Request $request)
    {
    	if (Auth::check() && (Auth::user()->user_type == 'customer'))
    	{
    		$check=Wishlist::where(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id])->first();
    		if (is_null($check)) {
    			$wishlist=new Wishlist();
    			$wishlist->user_id=Auth::user()->id;
    			$wishlist->product_id=$request->product_id;
    			$wishlist->save();
    			$notification=['status'=>'200', 'type'=>'success','message'=>"Successfully added to wishlist","total_wishlist"=>Wishlist::total_wishlist()];
    		}else{
    			$notification=['status'=>'201', 'type'=>'success','message'=>"Already added to wishlist"];
    		}
    	}else{
    		 $notification=['status'=>'401', 'type'=>'error','message'=>'Please Login first'];
    	}
    	echo json_encode($notification);
    }

    public function view_wishlist()
    {
    	if (Auth::check() && (Auth::user()->user_type == 'customer')) {
    		$wishlists=Wishlist::where('user_id',Auth::user()->id)->get();
    		 return view('user.view_wishlist',compact('wishlists'));
    	}else{
    		$notification=array(
    		 'message'=>'Please Login first !!',
    		 'alert-type'=>'info'
    		 );
    		return redirect()->back()->with($notification);
    	}
       
    }

    public function delete_wishlist (Request $request)
    {
      
        $wishlist=Wishlist::findOrFail($request->wishlist_id);
        $wishlist->delete();
        $notification=['status'=>'200', 'type'=>'success','message'=>'Succeddfully deleted','total_wishlist'=>Wishlist::total_wishlist()];

        echo json_encode($notification);
    }
}
