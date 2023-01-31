<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "store";
    protected $fillable = [
        'id','category', 'manufacture_name', 'product_name','usage','unit','photo','description','created_at','updated_at','user_id','qty','tags','is_active'
    ];
}
    