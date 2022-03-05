<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Seller\Withdraw;

class WithdrawController extends Controller
{
    
	public function __construct()
	{
	    $this->middleware('auth');
	    $this->middleware('seller');
	}

	public function balance()
	{
		
		$seller=User::findOrFail(Auth::user()->id);
		return view('seller.withdraw.balance',compact('seller'));
	}


	public function withdraw(Request $request)
	{


		if ($request->isMethod("post")){
		    DB::beginTransaction();
		    try {
		       $seller=Auth::user();
		       if ($request->withdraw_amount>$seller->main_balance) {
		          return \response()->json([
		               'message' => 'You have no enough balance',
		               'status_code' => 201
		           ], Response::HTTP_OK);

		       }else{
		        if ($request->withdraw_amount>=100) {
		            // withdraw request
		            $withdraw=new Withdraw();
		            $withdraw->withdraw_amount    =$request->withdraw_amount;
		            $withdraw->seller_id          =$seller->id;
		            $withdraw->account_holder_name=$request->account_holder_name;
		            $withdraw->account_number     =$request->account_number;
		            $withdraw->bank_name          =$request->bank_name;
		            $withdraw->branch_name        =$request->branch_name;
		            $withdraw->note               =$request->note;
		            $withdraw->type               ="seller";
		            $withdraw->save();

		            // detuched seller amount
		            $seller_current_balance=$seller->main_balance;
		            $remain_balance        =$seller_current_balance-$request->withdraw_amount;
		            $seller->main_balance  =$remain_balance;
		            $seller->save();

		            DB::commit();
		             return \response()->json([
		            'message'=>'Your request sent successfully',
		            'status_code'=>200
		           ],Response::HTTP_OK);


		        }else{
		          return \response()->json([
		            'message'=>'Yor amount should should grater than 100',
		            'status_code'=>202
		         ],Response::HTTP_OK);
		        }

		       }

		    }catch (QueryException $e){
		        DB::rollBack();
		        $errors=$e->getMessage();
		        return \response()->json([
		            'errors'=>$errors,
		            'status_code'=>500,
		        ],Response::HTTP_INTERNAL_SERVER_ERROR);
		    }
		}
	}


	public function datatable(){
		$datas=Withdraw::where('seller_id',"=",Auth::user()->id)->orderBy('id','DESC')->get();
		
		 return DataTables::of($datas)
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
		->rawColumns(['withdraw_amount'])
		 ->make(true);
	}


	public function withdraw_history()
	{

		return view('seller.withdraw.withdraw_history');
	}


}
