<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Poney;

class GestionJournaliereController extends Controller
{
    public function index()
    {
        $date_du_jour = Carbon::now()->format('Y-m-d');

        // Récupérer les réservations du jour
        $reservations = Reservation::whereDate('start_time', $date_du_jour)->with('poneys')->get();
        
        // Récupérer la liste des poneys
        $poneys = Poney::all();

        return view('gestion-journaliere.index', compact('date_du_jour', 'reservations', 'poneys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'people_count' => 'required|integer|min:1',
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric|min:0',
            'poneys' => 'array'
        ]);

        $reservation = Reservation::create([
            'client_name' => $request->client_name,
            'people_count' => $request->people_count,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price' => $request->price,
            'date' => now()->toDateString(),
        ]);

        // Assigner les poneys
        $reservation->poneys()->attach($request->poneys);

        return redirect()->route('gestion_journaliere.index')->with('success', 'Réservation ajoutée.');
    }

}
