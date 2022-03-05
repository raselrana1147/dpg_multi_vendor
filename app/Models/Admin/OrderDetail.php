<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller\Product;
use App\Models\Admin\Color;
use App\Models\Admin\Size;
use App\Models\User;

class OrderDetail extends Model
{
    use HasFactory;

      public function product()
      {
      	return $this->belongsTo(Product::class);
      }

      public function color()
      {
    	return $this->belongsTo(Color::class);
      }

      public function size()
      {
    	return $this->belongsTo(Size::class);
      }

      public function seller(){
          return $this->belongsTo(User::class,'seller_id');
      }
}
