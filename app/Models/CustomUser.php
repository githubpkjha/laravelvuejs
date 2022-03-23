<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    use HasFactory;
    protected $table = 'custom_users';
    protected $fillable = ['id','name','surname','email','phone','company','address','photo','created_at','updated_at'];
}
