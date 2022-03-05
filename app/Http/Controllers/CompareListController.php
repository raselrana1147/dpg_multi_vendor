<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CampareList;

class CompareListController extends Controller
{
    

    public function add_to_comparelist(Request $request)
    {
    	if (Auth::check() && (Auth::user()->user_type == 'customer')) 
    	{
    		$check=CampareList::where(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id])->first();
    		if (is_null($check)) {
    			$comparelist=new CampareList();
    			$comparelist->user_id=Auth::user()->id;
    			$comparelist->product_id=$request->product_id;
    			$comparelist->save();
    			$notification=['status'=>'200', 'type'=>'success','message'=>"Successfully added to comparelist","total_camparelist"=>CampareList::total_camparelist()];
    		}else{
    			$notification=['status'=>'201', 'type'=>'success','message'=>"Already added to camparelist"];
    		}
    	}else{
    		 $notification=['status'=>'401', 'type'=>'error','message'=>'Please Login first'];
    	}
    	echo json_encode($notification);
    }

    public function view_comparelist()
    {
    	if (Auth::check() && (Auth::user()->user_type == 'customer')) {
    		$comparelists=CampareList::where('user_id',Auth::user()->id)->get();
    		 return view('user.view_comparelist',compact('comparelists'));
    	}else{
    		$notification=array(
    		 'message'=>'Please Login first !!',
    		 'alert-type'=>'info'
    		 );
    		return redirect()->back()->with($notification);
    	}
       
    }

    public function delete_comparelist(Request $request)
    {
      
        $comparelist=CampareList::findOrFail($request->comparelist_id);
        $comparelist->delete();
        $notification=['status'=>'200', 'type'=>'success','message'=>'Succeddfully deleted',"total_camparelist"=>CampareList::total_camparelist()];

        echo json_encode($notification);
    }
}
