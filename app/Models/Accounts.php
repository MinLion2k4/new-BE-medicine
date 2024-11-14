<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Accounts extends Model
{
   
   protected $table = 'accounts';

   protected $primaryKey = 'id';
   public $incrementing = false;
   protected $fillable = [ 'full_name', 'email', 'password', 'token', 'phone', 'status', 'role'];
   protected $hidden = [
      'password',        
      'remember_token',
      'created_at',
      'updated_at',   
  ];
}
