<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Seller\Withdraw;

class WithdrawRequestController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function datatable()
    {
    	$datas=Withdraw::orderBy('id','DESC')->get();
    	
    	 return DataTables::of($datas)
    	 ->editColumn('seller',function(Withdraw $data){
    	     return $data->seller->full_name;
    	 })
    	 ->editColumn('withdraw_amount',function(Withdraw $data){
    	     return currency().number_format($data->withdraw_amount,2);
    	 })
    	 ->editColumn('note',function(Withdraw $data){
    	     return $data->note !=null ? $data->note : 'No Note';
    	 })
    	 ->editColumn('comment',function(Withdraw $data){
    	     return $data->comment !=null ? $data->comment : 'No comment';
    	 })

    	 ->editColumn('created_at',function(Withdraw $data){
    	     return date('d-m-Y H:m',strtotime($data->created_at));
    	 })
    	  ->editColumn('action',function(Withdraw $data){
    	    	 $pending = $data->status =="pending" ? 'selected' : '';
    	    	 $accept = $data->status =="accept" ? 'selected' : '';
    	    	 $reject = $data->status =="reject" ? 'selected' : '';
    	    	 
    	         return '  <select class="form-control update_withdraw_status" withdraw_id="'.$data->id.'" data-action="'.route('admin.update_withdraw_status').'">
    	                         <option value="pending" '.$pending.'>pending</option>
    	                         <option value="accept" '.$accept.'>accept</option>
    	                         <option value="reject" '.$reject.'>reject</option>

    	                   </select>';
    	 })
    	->rawColumns(['action'])
    	 ->make(true);
    }


    public function index()
    {
    	return view('admin.withdraw.index');
    }


    public function  update_withdraw_status(Request $request){
    	if ($request->isMethod("post")){
    	    DB::beginTransaction();
    	    try {
    	        $withdraw=Withdraw::findOrFail($request->withdraw_id);
    	        $withdraw->status=$request->status;
    	        $withdraw->save();

    	            // if ($request->status==='accept'){
    	            //    $transaction=new Transaction();
    	            //    if ($withdraw->seller_id !==null){
    	            //        $transaction->seller_id=$withdraw->seller_id;
    	            //        $transaction->type="seller";
    	            //    }else{
    	            //        $transaction->owner_id=$transaction->owner_id;
    	            //        $transaction->type="owner";
    	            //    }
    	            //    $transaction->transaction_number=rand(100000,999999);
    	            //    $transaction->amount=$withdraw->withdraw_amount;
    	            //    $transaction->save();

    	            // }

    	        if ($request->status==='reject'){
    	            
    	                $seller=User::findOrFail($withdraw->seller_id);
    	                $seller_current_balance=$seller->main_balance;
    	                $seller_total_balance=$seller_current_balance+$withdraw->withdraw_amount;
    	                $seller->main_balance=$seller_total_balance;
    	                $seller->save();
    	   
    	        }
    	        DB::commit();
    	        return \response()->json([
    	            'message'=>"Successfull updated",
    	            'status_code'=>200,
    	        ],Response::HTTP_OK);
    	    }catch (QueryException $e){
    	        DB::rollBack();
    	        $error=$e->getMessage();
    	        return \response()->json([
    	            'error'=>$error,
    	            'status_code'=>500,
    	        ],Response::HTTP_INTERNAL_SERVER_ERROR);
    	    }

    	}
    }
}
