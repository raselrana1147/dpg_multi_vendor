<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Seller\Product;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\OrderCommission;
use Carbon\Carbon;

class AdminController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
         $orders= DB::table('orders')
         ->select('*', DB::raw('count(*) as total'))
         ->groupBy('status')
         ->get();

    
           // $months= ["Jan", "Fab", "Mar", "Apr", "May","Jun","July","Aug","Sept","Oc","Nob","Dec"];

            //for($i = 1; $i < 13; $i++) {

               // $months[$i] = Order::whereMonth('created_at', $i)->get();
                // ->groupBy(function ($d) {
                // return $d->created_at->format('m');
                // })->map(function ($d) {
                //     return $d->count();
                // });
            //}

         $months = Order::select('*',
                     DB::raw('sum(grand_total) as sums'),
                     DB::raw('count(*) as total'),
                     DB::raw("DATE_FORMAT(created_at,'%M') as months"),
                     DB::raw("DATE_FORMAT(created_at,'%m') as monthKey"),
                    DB::raw("DATE_FORMAT(created_at,'%Y') as Year")
                 )
                 ->groupBy('Year','months','monthKey')
                 ->orderBy('created_at', 'ASC')
                 ->whereYear('created_at', date('Y'))
                 ->get();



         $month_salling = [0,0,0,0,0,0,0,0,0,0,0,0];

         foreach($months as $order){
             $month_salling[$order->monthKey-1] = $order->sums;
         }
        
        $new_orders=Order::latest()->take(5)->get();
        $new_products=Product::latest()->take(5)->get();
        $new_brands=Brand::latest()->take(5)->get();
        $new_categories=Category::whereNull('parent_id')->latest()->take(5)->get();
        $total_order=Order::count();
        $order_commission=OrderCommission::sum('company_will_get');
        $seller_amount=OrderCommission::sum('seller_amount');
        $total_sell=Order::sum('sub_total');

    	return view("admin.index",compact('orders','new_orders','new_products','new_brands','new_categories','total_order','order_commission','seller_amount','total_sell',"month_salling"));
    }
}
