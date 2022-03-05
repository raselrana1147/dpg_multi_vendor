<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Withdraw extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function seller()
    {
    	return $this->belongsTo(User::class,'seller_id');
    }
}
