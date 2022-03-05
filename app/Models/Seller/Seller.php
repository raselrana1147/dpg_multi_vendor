<?php

namespace App\Models\Seller;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Seller\Product;

class Seller extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $guarded = [];

   public function product()
   {
   		return $this->belongsTo(Product::class);
   }
    
}
