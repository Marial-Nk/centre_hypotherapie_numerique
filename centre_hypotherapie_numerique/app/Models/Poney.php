<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poney extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'work_time', 'max_work_time'];

    /**
     * Vérifie si le poney est disponible pour une réservation.
     */
    public function isAvailable()
    {
        return $this->work_time < $this->max_work_time;
    }

    /**
     * Augmente le temps de travail du poney avec la durée de la réservation.
     */
    public function addWorkTime($hours)
    {
        if ($hours < 0) {
            return; // Empêche une valeur négative
        }

        if ($this->isAvailable()) {
            $this->work_time += $hours;

            // Empêcher de dépasser la limite
            if ($this->work_time > $this->max_work_time) {
                $this->work_time = $this->max_work_time;
            }

            // 🔹 Ajoute la mise à jour de la base de données
            $this->save();
        }
    }

}

