<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends User
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'managers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'access_level'
    ];

}
