<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Users extends Model
{

    use HasFactory;
    protected $table = 'table_users';
    protected $fillable = ['name', 'email', 'alamat'];
}
