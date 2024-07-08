<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_time',
        'arrival_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
