<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poney extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'work_time']; // Ajouter les champs autorisés

}
