<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TBLDispatch extends Model
{
    protected $table = "tbl_dispatch";
    protected $fillable = [
        'id','order_id','barcode_id','category_name','category_id','manufacturer_name','manufacturer_id','product_name','product_id','prod_price','unit_name','unit_id','required_qty','provided_qty','notes','created_at','updated_at'
    ];
}