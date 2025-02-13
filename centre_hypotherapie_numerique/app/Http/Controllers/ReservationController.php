<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Poney;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('poneys')->whereDate('date', today())->get();
        return view('reservation.index', compact('reservations'));
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
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric|min:0',
            'poneys' => 'required|array|min:' . $request->people_count . '|max:' . $request->people_count,
        ], [
            'poneys.min' => 'Le nombre de poneys assignés doit être exactement égal au nombre de personnes.',
            'poneys.max' => 'Le nombre de poneys assignés doit être exactement égal au nombre de personnes.',
        ]);

        // 🚀 Correction : Ajouter la date du jour pour que les réservations spontanées apparaissent !
        $reservation = Reservation::create([
            'client_name' => $request->client_name,
            'people_count' => $request->people_count,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price' => $request->price,
            'date' => now()->toDateString(), // ✅ On ajoute la date du jour
        ]);

        $reservation->poneys()->attach($request->poneys);

        return redirect()->route('gestion-journaliere.index')->with('success', 'Réservation ajoutée.');
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
