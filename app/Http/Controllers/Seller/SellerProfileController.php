<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Image;
use Str;

class SellerProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('seller');
    }

    public function profile_form()
    {
    	$seller=Auth::user();
    	return view('seller.profile.profile',compact('seller'));
    }


    public function profile_update(Request $request)
    {
    	$user=User::findOrFail($request->id);
    	$this->validate($request,[
    	    'phone'=>'unique:users,phone,'.$user->id
    	]);
    	    
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
    	 return json_encode($notification);
    }
    public function password_form()
    {
         return view('seller.profile.change_password');
    }


    public function change_password(Request $request)
    {
         
            $user=Auth::user();
            if (Hash::check($request->old_password,$user->password)) {
               if (strlen($request->new_password) >=6) {
                    if ($request->new_password===$request->password_confirmation) 
                    {
                         $user->update(['password'=>Hash::make($request->new_password)]);
                         $notification=['alert'=>'error','message'=>trans('seller.item_updated'),'status'=>200];
                    }else
                    {
                        $notification=['alert'=>'error','message'=>trans('seller.password_confirm_match'),'status'=>405];
                    }
                 
               }else{
                     $notification=['alert'=>'error','message'=>trans('seller.password_length'),'status'=>405];
               }
            }else{
              $notification=['alert'=>'error','message'=>trans('seller.old_password_not_match'),'status'=>403];
            }
         
         return json_encode($notification);
    }

    public  function shop_logo_form(){
        $seller=Auth::user();
        return view("seller.profile.set_logo",compact('seller'));
    }


    public function add_shop_logo(Request $request)
    {
        $user=User::findOrFail($request->id);
        $user->shop_name=$request->shop_name;
         if($request->hasFile('logo')){

                if (File::exists(base_path('/assets/backend/image/shop_logo/'.$user->shop_logo))) 
                {
                  File::delete(base_path('/assets/backend/image/shop_logo/'.$user->shop_logo));
                }
               $image=$request->logo;
               $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
              
               $image_path = base_path().'/assets/backend/image/shop_logo/'.$image_name;
               //Resize Image
               Image::make($image)->resize(465,465)->save($image_path);
               $user->shop_logo =$image_name;  
       }

        $user->save();
        $notification=['alert'=>'success','message'=>trans('seller.item_updated'),'status'=>200];
     return json_encode($notification);
    }
}
