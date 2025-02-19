<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Poney;

class ReservationController extends Controller
{
    /**
     * Affiche la liste des réservations.
     */
    public function index()
    {
        $reservations = Reservation::getTodayReservations(); // ✅ Utilise la méthode qui filtre par date
        $date_du_jour = now()->toDateString(); // ✅ Récupère la date du jour

        return view('reservation.index', compact('reservations', 'date_du_jour'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poneys = Poney::all();
        return view('reservation.create', compact('poneys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'people_count' => 'required|integer|min:1',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'price' => 'required|numeric|min:0',
            'poneys' => 'required|array|min:' . $request->people_count . '|max:' . $request->people_count,
        ], [
            'poneys.min' => 'Le nombre de poneys assignés doit être exactement égal au nombre de personnes.',
            'poneys.max' => 'Le nombre de poneys assignés doit être exactement égal au nombre de personnes.',
        ]);

        // ✅ Création de la réservation
        $reservation = Reservation::create([
            'client_name' => $request->client_name,
            'people_count' => $request->people_count,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price' => $request->price,
            'date' => now()->toDateString(),
        ]);

        // ✅ Assigner les poneys à la réservation
        $reservation->poneys()->attach($request->poneys);

        // ✅ Récupérer la durée de la réservation en heures
        $duration = (strtotime($request->end_time) - strtotime($request->start_time)) / 3600;

        // ✅ Augmenter le temps de travail des poneys sélectionnés
        foreach ($request->poneys as $poneyId) {
            $poney = Poney::findOrFail($poneyId);
            $poney->addWorkTime($duration); // Ajout du temps de travail
        }

        return redirect()->route('gestion-journaliere.index')->with('success', 'Réservation ajoutée et poneys assignés.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
