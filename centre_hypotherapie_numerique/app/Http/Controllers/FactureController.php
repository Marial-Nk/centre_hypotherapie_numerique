<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FactureController extends Controller
{
    
    public function index(Request $request)
{
    
    // 🔹 Récupérer le mois sélectionné ou par défaut le mois en cours
    $moisSelectionne = $request->input('mois', Carbon::now()->format('Y-m'));

    // 🔹 Historique des recettes (mois et total des réservations)
    $recettesParMois = DB::table('reservations')
    ->selectRaw("DATE_FORMAT(date, '%Y-%m') as mois, COALESCE(SUM(price), 0) as total")
    ->whereNotNull('date') //  Ignore les valeurs NULL
    ->whereRaw("DATE_FORMAT(date, '%Y-%m') IS NOT NULL") // Empêche MySQL de renvoyer "0000-00"
    ->groupBy(DB::raw("DATE_FORMAT(date, '%Y-%m')"))
    ->orderBy('mois', 'desc')
    ->get();

    $clientsParMois = DB::table('reservations')
    ->selectRaw("DATE_FORMAT(date, '%Y-%m') as mois, client_name, COUNT(DISTINCT date) as jours_reserves, SUM(price) as total_client")
    ->whereNotNull('date')
    ->groupBy(DB::raw("DATE_FORMAT(date, '%Y-%m')"), 'client_name') // ✅ Groupement par client et mois
    ->orderBy('mois', 'desc')
    ->get()
    ->groupBy('mois'); // ✅ Regroupe les clients par mois pour un accès facile dans Blade

    // 🔹 Détails des réservations pour le mois sélectionné
    $facturesDuMois = DB::table('reservations')
        ->select('client_name', DB::raw('COUNT(*) as jours_reserves, SUM(price) as total_reservations'))
        ->whereRaw("DATE_FORMAT(start_time, '%Y-%m') = ?", [$moisSelectionne])
        ->groupBy('client_name')
        ->get();

    // 🔹 Calcul du total du mois
    $totalMois = $facturesDuMois->sum('total_reservations');
    //dd($recettesParMois->toArray(), $clientsParMois->toArray(), $facturesDuMois->toArray());


    return view('factures.index', compact('recettesParMois', 'facturesDuMois', 'totalMois', 'moisSelectionne', 'clientsParMois'));
}

public function store(Request $request)
{
    $request->validate([
        'client_name' => 'required|string|max:255',
        'people_count' => 'required|integer|min:1',
        'start_time' => 'required',
        'end_time' => 'required',
        'price' => 'required|numeric|min:0',
    ]);

    Reservation::create([
        'client_name' => $request->client_name,
        'people_count' => $request->people_count,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'price' => $request->price,
        'date' => now()->toDateString(), // ✅ Remplit `date` avec la date du jour
    ]);

    return redirect()->route('factures.index')->with('success', 'Rendez-vous créé avec succès.');
}


public function envoyerFacture(Request $request)
{
    $client = $request->input('client');
    $mois = $request->input('mois');

    // Simulation de l'envoi de facture (peut être remplacé par un email réel)
    return redirect()->route('factures.index')->with('success', "Facture envoyée à $client pour le mois de " . Carbon::createFromFormat('Y-m', $mois)->translatedFormat('MMMM Y'));
}

}
