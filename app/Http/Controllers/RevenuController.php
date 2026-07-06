<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revenu;

class RevenuController extends Controller
{
    public function index() {
        $revenus = Revenu::all();
         return view('revenus/index', ['revenus' => $revenus]);
    }

    public function show($id) {
        $revenus=Revenu::findOrFail($id);
        return view('revenus/show', ['revenus'=> $revenus]);
    }

    public function store(Request $request) {
        Revenu::create([
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
        return redirect('/revenus');
    }

    public function create() {
        return view('revenus/create');
    }

    public function update(Request $request, $id) {
        $revenu = Revenu::findOrFail($id);

        $revenu->update([
            'nom' => $request->nom ?? $revenu->nom,
            'description' => $request->description ?? $revenu->description,
            'montant' => $request->montant ?? $revenu->montant,
            'date_debut' => $request->date_debut ?? $revenu->date_debut,
            'ponctuel' => $rsquest->ponctuel ?? $revenu->ponctuel,
            'frequence' => $request->frequence ?? $revenu->frequence,
            'date_fin' => $request->date_fin ?? $revenu->date_debut,
            'duree' => $request->duree ?? $revenu->duree,
            'compte_id' => 1,
        ]);
        return redirect('/revenus');
    }

    public function edit($id) {
        $revenu = Revenu::findOrFail($id);
        return view('revenus.edit', ['revenus' => $revenu]);
    }

    public function destroy($id) {
        $delete = Revenu::findOrFail($id);
        $delete->deleteOrFail($id);

        return redirect('/revenus');
    }
}
