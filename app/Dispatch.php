<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $table = "dispatch";
    protected $fillable = [
        'id','store_id', 'user_id', 'qr_code','created_at','updated_at','qty','action'
    ];
}