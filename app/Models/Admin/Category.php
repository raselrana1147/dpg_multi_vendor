<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];

    // parent relation
        public function parent(){

           return $this->belongsTo(self::class , 'parent_id');
       }
       //sub relation
        public function sub_category()
       {
           return $this->hasMany(self::class ,'parent_id');
       }
}
