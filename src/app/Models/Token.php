<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $guarded = [];

    protected $casts = [
        'expires' => 'datetime',
        'scopes' => 'array'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExpiresInAttribute()
    {
        return $this->expires->diffInSeconds(now());
    }
}
