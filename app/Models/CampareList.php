<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CampareList;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller\Product;

class CampareList extends Model
{
    use HasFactory;

    use HasFactory;

     public function product()
     {
     	return $this->belongsTo(Product::class);
     }

     public static function total_camparelist()
     {
        $item=0;
       if (Auth::check()) {
         $item=CampareList::where('user_id',Auth::user()->id)->count();
       }
      
       return $item;
    }
}
