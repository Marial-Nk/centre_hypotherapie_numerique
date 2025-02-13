<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;

class FactureController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'historique des recettes par mois
        $recettesParMois = Facture::selectRaw('mois, SUM(total_reservations) as total')
            ->groupBy('mois')
            ->orderBy('mois', 'desc')
            ->get();

        // Déterminer le mois sélectionné (ou par défaut, le mois en cours)
        $moisSelectionne = $request->query('mois', date('Y-m'));

        // Récupérer les clients et détails des réservations pour ce mois
        $facturesDuMois = Facture::where('mois', $moisSelectionne)->get();

        // Calculer le total du mois sélectionné
        $totalMois = $facturesDuMois->sum('total_reservations');

        return view('factures.index', compact('recettesParMois', 'facturesDuMois', 'moisSelectionne', 'totalMois'));
    }
}
