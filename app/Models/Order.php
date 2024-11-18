<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = ['order_date','full_name','email','phone','address','total_price','status'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



}
