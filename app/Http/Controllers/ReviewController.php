<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    


    public function review(Request $request)
    {

    	$review=new Review();
    	$review->ratting=$request->ratting;
    	$review->review=$request->review;
    	$review->product_id=$request->product_id;
    	$review->name=$request->name;
    	$review->email=$request->email;
    	if (Auth::check() && Auth::user()->user_type="customer")
    	 {
    		$review->user_id=Auth::user()->id;
    	}
    	$review->save();

    	$reviews=Review::where('product_id',$request->product_id)->latest()->get();

    	$setReview='';
    	if (count($reviews)>0) {
    	   foreach ($reviews as $data) {

                    $star='';
                    for ($i=0; $i <5 ; $i++) { 
                       if ($i<$data->ratting) {
                            $star.='<small class="far fa-star"></small>';
                       }else{
                             $star.='<small class="far fa-star text-muted"></small>';
                       }
                    };

    	      $setReview.='<div class="border-bottom border-color-1 pb-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">'.$star.'</div>
                                </div>
                                <p class="text-gray-90">'.$data->review.'</p>
                                <div class="mb-2">
                                    <strong>'.$data->name.'</strong>
                                    <span class="font-size-13 text-gray-23">'.date('d, F, Y', strtotime($data->created_at)).'</span>
                                </div>        
                         </div>';
    	   }
    	}else{
    	  $setReview.='';
    	}

      // review are clculatting
      $product_id=$request->product_id;

      $total_review=Review::where('product_id',$product_id)->count();
      $avarage=round(Review::where('product_id',$product_id)->avg('ratting'),2);

      $one_ratting=0;
      $two_ratting=0;
      $three_ratting=0;
      $four_ratting=0;
      $five_ratting=0;

      if ($total_review>0) {
        
        $one_ratting=round((Review::where(['product_id'=>$product_id,'ratting'=>1])->count()*100)/$total_review,2);
        $two_ratting=round((Review::where(['product_id'=>$product_id,'ratting'=>2])->count()*100)/$total_review,2);
        $three_ratting=round((Review::where(['product_id'=>$product_id,'ratting'=>3])->count()*100)/$total_review,2);
        $four_ratting=round((Review::where(['product_id'=>$product_id,'ratting'=>4])->count()*100)/$total_review,2);
        $five_ratting=round((Review::where(['product_id'=>$product_id,'ratting'=>5])->count()*100)/$total_review,2);
      }

      $review_info=array(
                      'total_review'=>$total_review,
                      'avarage'=>$avarage,
                      'one_ratting'=>$one_ratting,
                      'two_ratting'=>$two_ratting,
                      'three_ratting'=>$three_ratting,
                      'four_ratting'=>$four_ratting,
                      'five_ratting'=>$five_ratting
                  );

    	$notification=['status'=>'200', 'type'=>'success','message'=>trans('title.item_added'),'review'=>$setReview,'review_info'=>$review_info];
    	echo json_encode($notification);
    }
    // <small class="far fa-star text-muted"></small>

    public function load_review(Request $request)
    {

         $reviews=Review::latest()->where('product_id',$request->product_id)
         ->offset($request['start'])
         ->limit($request['limit'])
         ->get();

          $setReview='';
          if (count($reviews)>0) {
             foreach ($reviews as $data) {
                
                $star='';
                for ($i=0; $i <5 ; $i++) { 
                   if ($i<$data->ratting) {
                        $star.='<small class="far fa-star"></small>';
                   }else{
                         $star.='<small class="far fa-star text-muted"></small>';
                   }
                };
                $setReview.='<div class="border-bottom border-color-1 pb-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    '.$star.'
                                    </div>
                                </div>
                                <p class="text-gray-90">'.$data->review.'</p>
                                <div class="mb-2">
                                    <strong>'.$data->name.'</strong>
                                    <span class="font-size-13 text-gray-23">'.date('d, F, Y', strtotime($data->created_at)).'</span>
                                </div>        
                         </div>';
             }
          }else{
            $setReview.='';
          }
        $total_review=Review::where('product_id',$request->product_id)->count();
        $notification=['status'=>'200', 'type'=>'success','set_review'=>$setReview,'total_review'=>$total_review];
        echo json_encode($notification);
    }
}
