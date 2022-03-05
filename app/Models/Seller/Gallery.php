<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller\Product;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
