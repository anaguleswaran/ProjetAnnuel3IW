<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;

class CompteController extends Controller
{
    public function index() {
        $comptes = Compte::all();
         return view('comptes/comptes', ['comptes' => $comptes]);
    }

    public function show($id) {
        $compte=Compte::findOrFail($id);
        return view('comptes/compte', ['compte'=> $compte]);
    }

    public function addCompte(Request $request) {
        Compte::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'taux_remuneration' => $request->taux_remuneration ?? 0,
            'taux_imposition' => $request->taux_imposition ?? 0,
            'user_id' => auth()->id(),
        ]);
        return redirect('/comptes');
    }

    public function create() {
        return view('comptes/create');
    }

    public function update(Request $request, $id) {
        $compte = Compte::findOrFail($id);

        $compte->update([
            'nom' => $request->nom ?? $compte->nom,
            'description' => $request->description ?? $compte->description,
            'taux_remuneration' => $request->taux_remuneration ?? $compte->taux_remuneration,
            'taux_imposition' => $request->taux_imposition ??$compte->taux_imposition,
            'user_id' => auth()->id(),
        ]);
        return redirect('/comptes');
    }

    public function edit($id) {
        $compte = Compte::findOrFail($id);
        return view('/comptes/update', ['compte' => $compte]);
    }

    public function destroy($id) {
        $delete = Compte::findOrFail($id);
        $delete->deleteOrFail($id);

        return redirect('/comptes');
    }


}
