<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Admin\Order;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\OrderCommission;
use App\Models\Admin\EarningHistory;
use App\Models\Admin\CommissionDetail;
use App\Models\Seller\Stock;
use App\Models\User;
use App\Models\Seller\Product;

class OrderController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('admin');
     }


     public function datatable()
     {
        $datas=Order::orderBy('id','DESC')->get();
       
         return DataTables::of($datas)
         ->editColumn('sub_total',function(Order $data){
         	 return currency().number_format($data->sub_total,2);
         })
         ->editColumn('tax',function(Order $data){
         	 return currency().number_format(tax(),2);
         })
         ->editColumn('shipping_charge',function(Order $data){
         	 return currency().number_format(shipping_charge(),2);
         })
         ->editColumn('grand_total',function(Order $data){
         	 return currency().number_format($data->grand_total,2);
         })
         ->editColumn('created_at',function(Order $data){
         	 return date('m-d-Y',strtotime($data->created_at));
         })
         ->editColumn('status',function(Order $data){
         	 $pending = $data->status =="pending" ? 'selected' : '';
         	 $processing = $data->status =="processing" ? 'selected' : '';
         	 $confirmed = $data->status =="confirmed" ? 'selected' : '';
         	 $delivered = $data->status =="delivered" ? 'selected' : '';
         	 $declined = $data->status =="declined" ? 'selected' : '';
              return '  <select class="form-control update_order_status" order_id="'.$data->id.'" data-action="'.route('admin.update.order_status').'">
                              <option value="pending" '.$pending.'>pending</option>
                              <option value="processing" '.$processing.'>processing</option>
                              <option value="confirmed" '.$confirmed.'>confirmed</option>
                              <option value="delivered" '.$delivered.'>delivered</option>
                              <option value="declined" '.$declined.'>declined</option>
                         
                        </select>';
         })
         ->editColumn('action',function(Order $data){
                  return '<a href="'.route('admin.order_detail',$data->id).'" class="btn btn-dark btn-sm">'.trans('admin.detail').'
                   </a>
                   <a href="'.route('admin.order_invoice',$data->id).'" class="btn btn-dark btn-sm">
                   	'.trans('admin.invoice').'
                   </a>
                   ';
         })
        ->rawColumns(['status','action'])
         ->make(true);
     }


     public function index()
     {
     	return view('admin.order.index');
     }

     public function order_detail($id)
     {
        $order=Order::findOrFail($id);
        return view('admin.order.order_detail',compact('order'));
     }

     public function order_invoice($id)
     {
        $order=Order::findOrFail($id);
        return view('admin.order.order_invoice',compact('order'));
     }

     public function update_status(Request $request){
        // dd($request->all());
         if ($request->isMethod('post')){
             DB::beginTransaction();
              $order=Order::findOrFail($request->order_id);
                 $order->status=$request->status;
                 $order->save();
                 // reduce stock after confirm order
                 if ($request->status==="confirmed"){
                     $data=OrderDetail::where('order_id',$request->order_id)->get();
                     foreach ($data as $item){
                             $stock=Stock::where('product_id',$item->product_id)
                                 ->where('size_id',$item->size_id)
                                 ->where('color_id',$item->color_id)
                                 ->first();
                             $stock->quantity -=$item->product_quantity;
                             $stock->save();
                     }
                     // add stock if order declined
                 }elseif ($request->status==="declined"){
                          $data=OrderDetail::where('order_id',$request->order_id)->get();
                         foreach ($data as $item){
                         
                             $stock=Stock::where('product_id',$item->product_id)
                                 ->where('size_id',$item->size_id)
                                 ->where('color_id',$item->color_id)
                                 ->first();
                             $stock->quantity +=$item->product_quantity;
                             $stock->save();

                      
                      }
                 }elseif ($request->status==="delivered") {
                     // commission is calculating
                            if (!is_null($order)) {

                                 $order_items     =$order->items;
                                 $seller_amount   =0;
                                 $company_will_get=0;
                                 $total_amount    =0;

                               foreach ($order_items as  $item) {

                              $product_price=$item->product->current_price;

                               $check_comm_detail=CommissionDetail::
                              where("order_id",$order->id)->get();

                             $comp_comission=10;
                             $current_price=$product_price;
                             $total_amount+=$current_price*$item->product_quantity;
                           // calculate company commission
                             $unit_comp_commission =($current_price*$comp_comission)/100;
                             $total_comp_commission=$unit_comp_commission*$item->product_quantity;
                             $company_will_get+=$total_comp_commission;

                             //end company commission
                                 if (count($check_comm_detail)!==count($order_items)) {
                                  $commission_detail=new CommissionDetail();
                                  $commission_detail->seller_id       =$item->seller_id;
                                  $commission_detail->order_id        =$order->id;
                                  $commission_detail->product_id      =$item->product_id;
                                  $commission_detail->quantity        =$item->product_quantity;
                                  $commission_detail->unit_commission =$unit_comp_commission;
                                  $commission_detail->total_commission=$total_comp_commission;
                                  $commission_detail->save();
                              }

                             // send seller earning in seller amount
                        
                                 $seller_amount=0;
                                 $seller_products=OrderDetail::where('order_id',$item->order_id)
                                     ->where('seller_id',$item->seller_id)
                                     ->get();

                                     foreach ($seller_products as $seller_product){
                                         $seller_pro_price=($seller_product->product->current_price)-($comp_comission*$seller_product->product->current_price)/100;
                                         $seller_amount+=$seller_pro_price*$seller_product->product_quantity;  
                                     }

                                     // store earning history
                                     $earning_history=EarningHistory::where('seller_id',$item->seller_id)
                                         ->where('order_id',$item->order_id)
                                         ->first();

                                     if (is_null($earning_history)){
                                         // main balance
                                         $seller=User::findOrFail($item->seller_id);
                                         $seller_current_balance=$seller->main_balance;
                                         $seller_current_balance+=$seller_amount;
                                         $seller->main_balance=$seller_current_balance;
                                         $seller->save();
                                         // earning history
                                         $earning=new EarningHistory();
                                         $earning->order_id=$item->order_id;
                                         $earning->seller_id=$item->seller_id;
                                         $earning->user_type="seller";
                                         $earning->selling_earning=$seller_amount;
                                         $earning->save();
                                     }

                            $prod=Product::findOrFail($item->product_id);
                            $prod->increment('total_order');
                            $prod->last_ordered_at=$order->created_at;
                            $prod->update();
                        }

                        $check_order=OrderCommission::where("order_id",$order->id)->first();
                        if (is_null($check_order)) {

                            $order_commission                  =new OrderCommission();
                            $seller_amount                     =$order->sub_total-$company_will_get;
                            $order_commission->order_id        =$order->id;
                            $order_commission->tax             =$order->tax;
                            $order_commission->charge          =$order->shipping_charge;
                            $order_commission->sub_total       =$order->sub_total;
                            $order_commission->grand_total     =$order->grand_total;
                            $order_commission->seller_amount   =$seller_amount;
                            $order_commission->company_will_get=$company_will_get;
                            $order_commission->save();
                        }

                     }

                 }

                 DB::commit();
                 return \response()->json([
                     'message' => 'Successfully updated',
                     'status_code' => 200
                 ],Response::HTTP_OK);
             }
         }
   
}
