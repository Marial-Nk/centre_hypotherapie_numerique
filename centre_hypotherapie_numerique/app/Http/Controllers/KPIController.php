<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poney;

class KPIController extends Controller
{
    /**
     * Affiche les statistiques des poneys.
     */
    public function index()
    {
        // Récupération des KPI depuis le modèle Poney
        $poneys = Poney::all();

        return view('poney.kpi', [
            'total_poneys' => Poney::nombreTotalPoneys(),
            'poneys_disponibles' => Poney::poneysDisponibles(),
            'taux_occupation_poneys' => Poney::tauxOccupation(),
            'poney_plus_utilise' => Poney::poneyPlusUtilise(),
            'poney_moins_utilise' => Poney::poneyMoinsUtilise(),
            'heures_totales_travaillees' => Poney::heuresTotalesTravaillees(),
            'poneys' => $poneys,
        ]);
    }
}
