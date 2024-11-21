<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouses extends Model
{
    protected $table = 'ware_house';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id','stock','input_date','input_cost'];
}

