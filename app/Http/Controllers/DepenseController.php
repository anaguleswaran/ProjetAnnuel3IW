<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depenses = depense::all();
         return view('depenses/index', ['depenses' => $depenses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depenses/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Depense::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'ponctuel' => $request->ponctuel ?? false,
            'frequence' => $request->frequence ?? null,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
            'compte_id' => 1,
        ]);
        return redirect('/depenses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depenses=Depense::findOrFail($id);
        return view('depenses/show', ['depenses'=> $depenses]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depense = depense::findOrFail($id);
        return view('depenses.edit', ['depenses' => $depense]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $depense = depense::findOrFail($id);

        $depense->update([
            'nom' => $request->nom ?? $depense->nom,
            'description' => $request->description ?? $depense->description,
            'montant' => $request->montant ?? $depense->montant,
            'date_debut' => $request->date_debut ?? $depense->date_debut,
            'ponctuel' => $request->ponctuel ?? $depense->ponctuel,
            'frequence' => $request->frequence ?? $depense->frequence,
            'date_fin' => $request->date_fin ?? $depense->date_debut,
            'duree' => $request->duree ?? $depense->duree,
            'compte_id' => 1,
        ]);
        return redirect('/depenses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $delete = Depense::findOrFail($id);
        $delete->deleteOrFail($id);

        return redirect('/depenses');
    }
}
