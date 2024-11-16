<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $primaryKey = 'id';

    protected $fillable = ['order_id','product_id','quantity'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
