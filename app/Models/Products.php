<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [ 'name','other_name','scientific_name', 'price', 'stock','origin','expiry', 'category_id',];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
