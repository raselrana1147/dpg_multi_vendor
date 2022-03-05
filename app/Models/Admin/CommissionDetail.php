<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order;
use App\Models\Seller\Product;
use App\Models\User;

class CommissionDetail extends Model
{
    use HasFactory;

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function seller()
    {
    	return $this->belongsTo(User::class,'seller_id');
    }
}
