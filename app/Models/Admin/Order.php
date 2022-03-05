<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\OrderDetail;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
