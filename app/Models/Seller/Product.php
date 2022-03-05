<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Seller\Gallery;
use App\Models\User;
use App\Models\Seller\Stock;
use App\Models\Admin\Brand;


class Product extends Model
{
    use HasFactory;


    public function category()
    {
    	return $this->belongsTo(Category::class,'category_id');
    }

    public function sub_category()
    {
    	return $this->belongsTo(Category::class,'sub_category_id');
    }

    public function galleries()
    {
    	return $this->hasMany(Gallery::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'seller_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function checkStocks()
    {
         return $this->hasMany(Stock::class);
    }


   
}
