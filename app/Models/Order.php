<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = ['order_date', 'product_id', 'account_id', 'total_price'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    

}
