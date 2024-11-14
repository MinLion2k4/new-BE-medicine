<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProducts extends Model
{
    protected $table = 'type_products';

    protected $primaryKey = 'id';
    // public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];
    protected $fillable = ['id','name', 'description'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
