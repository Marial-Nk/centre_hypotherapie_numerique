<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Poney;

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

    //Cela garantit que date sera toujours ajouté, même si l'utilisateur ne l’envoie pas.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            if (!$reservation->date) {
                $reservation->date = now()->toDateString(); // ✅ Définit automatiquement la date du jour
            }
        });
    }

    public function poneys()
    {
        return $this->belongsToMany(Poney::class);
    }

    /**
     * Assigne automatiquement le bon nombre de poneys disponibles à la réservation.
     */
    public function assignPoneys()
    {
        $availablePoneys = Poney::whereColumn('work_time', '<', 'max_work_time')
                                ->orderBy('work_time', 'asc') // Priorise les poneys les moins utilisés
                                ->limit($this->people_count)
                                ->get();

        if ($availablePoneys->count() < $this->people_count) {
            return false; // Pas assez de poneys disponibles
        }

        foreach ($availablePoneys as $poney) {
            $this->poneys()->attach($poney->id);

            // 🔹 Ajoute le temps de la réservation au poney
            $poney->addWorkTime($this->getDurationInHours());
        }

        return true;
    }

    /**
     * Calcule la durée de la réservation en heures.
     */
    public function getDurationInHours()
    {
        return (strtotime($this->end_time) - strtotime($this->start_time)) / 3600;
    }

    /**
     * Récupère uniquement les réservations prévues pour aujourd’hui.
     */
    public static function getTodayReservations()
    {
        return self::with('poneys')
                ->whereDate('date', now()->toDateString()) // Filtre les réservations du jour
                ->get();
    }

}


