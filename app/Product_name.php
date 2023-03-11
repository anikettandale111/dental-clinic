<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product_name extends Model
{
    protected $table = "product_name";
    protected $fillable = [
        'id','name', 'unit_id','category_id','manufracture_id','prod_price','user_id','is_active'
    ];

    public function location()
    {
        return $this->hasMany('App\User','location_id');
    }
}