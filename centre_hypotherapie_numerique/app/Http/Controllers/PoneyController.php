<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poney;
use App\Models\Reservation;


class PoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poneys = Poney::all();
        return view('poney.index', compact('poneys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'work_time' => 'integer|min:0',
            'max_work_time' => 'required|integer|min:1', // Assure qu'il est toujours défini
        ]);

        Poney::create([
            'name' => $request->name,
            'work_time' => $request->work_time ?? 0,
            'max_work_time' => $request->max_work_time,
        ]);

        return redirect()->route('poney.index')->with('success', 'Poney ajouté avec succès.');
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
    public function edit(Poney $poney)
    {
        return view('poney.edit', compact('poney'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poney $poney)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'work_time' => 'integer|min:0',
            'max_work_time' => 'required|integer|min:1',
        ]);

        $poney->update($request->all());

        return redirect()->route('poney.index')->with('success', 'Poney mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poney $poney)
    {
        $poney->delete();
        return redirect()->route('poney.index')->with('success', 'Poney supprimé avec succès.');
    }

    public function poneyKpi(Request $request)
    {
        // 🔹 Récupérer tous les poneys
        $poneys = Poney::select('name', 'work_time', 'max_work_time')->get();

        // 🔹 Heures travaillées et heures max globales
        $totalHoursWorked = $poneys->sum('work_time');
        $totalMaxHours = $poneys->sum('max_work_time');
        $workHourRatio = ($totalMaxHours > 0) ? round(($totalHoursWorked / $totalMaxHours) * 100, 2) : 0;

        // 🔹 Nombre de poneys disponibles et en repos
        $availablePoneys = $poneys->where('work_time', '<', 'max_work_time')->count();
        $restingPoneys = $poneys->where('work_time', '>=', 'max_work_time')->count();

        // 🔹 Récupérer la période sélectionnée (mois)
        $month = $request->input('month', now()->format('Y-m')); // Mois actuel par défaut

        // 🔹 Récupérer les réservations du mois choisi
        $reservations = Reservation::whereBetween('date', [
            "$month-01", date("Y-m-t", strtotime("$month-01"))
        ])->with('poneys')->get();

        // 🔹 Calculer les heures travaillées par poney sur la période
        $poneyUsage = [];
        foreach ($reservations as $reservation) {
            $duration = (strtotime($reservation->end_time) - strtotime($reservation->start_time)) / 3600;
            foreach ($reservation->poneys as $poney) {
                if (!isset($poneyUsage[$poney->name])) {
                    $poneyUsage[$poney->name] = 0;
                }
                $poneyUsage[$poney->name] += $duration;
            }
        }

        return view('poney.kpi', compact(
            'poneys',
            'workHourRatio',
            'availablePoneys',
            'restingPoneys',
            'poneyUsage',
            'month'
        ));
    }

}
