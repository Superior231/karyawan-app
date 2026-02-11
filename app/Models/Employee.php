<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'position', 'email', 'phone', 'address', 'status', 'avatar', 'joined_at'
    ];
}
