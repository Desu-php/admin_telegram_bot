<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_name',
        'start_date',
        'end_date',
        'status',
        'main_channel_id',
        'name'
    ];

    public function telegramUsers()
    {
        return $this->hasMany(TelegramUser::class);
    }

    public function mainChannel()
    {
        return $this->belongsTo(MainChannel::class);
    }
}
