<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'name',
        'origin_name',
        'avatar'
    ];

    public function advertisings()
    {
        return $this->hasMany(Advertising::class);
    }
}
