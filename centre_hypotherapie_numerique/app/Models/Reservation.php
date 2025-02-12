<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'people_count',
        'start_time',
        'end_time',
        'price',
        'date',
    ];

    public function poneys()
    {
        return $this->belongsToMany(Poney::class);
    }
}

