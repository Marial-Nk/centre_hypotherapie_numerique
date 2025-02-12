<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poney;

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
            'work_time' => 'required|integer|min:0',
        ]);
    
        Poney::create($request->all());
    
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
        $request->validate([
            'name' => 'required|string|max:255',
            'work_time' => 'required|integer|min:0',
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

}
