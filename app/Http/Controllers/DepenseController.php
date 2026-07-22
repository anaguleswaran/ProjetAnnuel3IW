<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use Carbon\Carbon;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $compteId)
    {
        $depenses = depense::select('*')->where('compte_id', $compteId)->get();
        foreach ($depenses as $depense) {
            $depense->date_debut = Carbon::parse($depense->date_debut)->format('d/m/Y');
            $depense->date_fin = Carbon::parse($depense->date_fin)->format('d/m/Y');
        }
         return view('depenses.index', ['depenses' => $depenses, 'compteId' => $compteId]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $compteId)
    {
        return view('depenses.create', ['compteId' => $compteId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $compteId)
    {
        Depense::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence ?? false,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
            'compte_id' => $compteId,
        ]);
        return redirect()->route('depenses.index', ['compteId' => $compteId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depenses=Depense::findOrFail($id);
        $depenses->date_debut = Carbon::parse($depenses->date_debut)->format('d/m/Y');
        if ($depenses->date_fin) {
            $depenses->date_fin = Carbon::parse($depenses->date_fin)->format('d/m/Y');
        }
        return view('depenses.show', ['depenses'=> $depenses]);
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
            'frequence' => $request->frequence ?? $depense->frequence,
            'date_fin' => $request->date_fin ?? $depense->date_debut,
            'duree' => $request->duree ?? $depense->duree,
            'compte_id' => $request->compte_id ?? $depense->compte_id,
        ]);
        return redirect()->route('depenses.index', ['compteId' => $depense->compte_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $delete = Depense::findOrFail($id);
        $delete->deleteOrFail($id);

        return redirect()->route('depenses.index', ['compteId' => $delete->compte_id]);
    }
}
