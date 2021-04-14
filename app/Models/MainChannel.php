<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'user_url',
        'avatar',
        'status'
    ];
}
