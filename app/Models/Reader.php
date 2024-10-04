<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'group_code',
        'phone',
        'email',
    ];

    use HasFactory;
}
