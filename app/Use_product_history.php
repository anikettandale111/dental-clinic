<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Use_product_history extends Model
{
    protected $table = "used_product_history";
    protected $fillable = [
        'id','tbl_dispatch_id', 'use_qty'
    ];
    
}