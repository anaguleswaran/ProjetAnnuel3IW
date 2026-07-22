<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revenu;
use Carbon\Carbon;

class RevenuController extends Controller
{
    public function index(string $compteId) {
        $revenus = Revenu::select('*')->where('compte_id', $compteId)->get();

        foreach ($revenus as $revenu) {
            $revenu->date_debut = Carbon::parse($revenu->date_debut)->format('d/m/Y');
            $revenu->date_fin = Carbon::parse($revenu->date_fin)->format('d/m/Y');
        }

         return view('revenus.index', ['revenus' => $revenus, 'compteId' => $compteId]);
    }

    public function show(string $id) {
        $revenus=Revenu::findOrFail($id);
        $revenus->date_debut = Carbon::parse($revenus->date_debut)->format('d/m/Y');
        if ($revenus->date_fin) {
            $revenus->date_fin = Carbon::parse($revenus->date_fin)->format('d/m/Y');
        }
        return view('revenus.show', ['revenus'=> $revenus]);
    }

    public function store(Request $request, string $compteId) {
        Revenu::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence ?? false,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
            'compte_id' => $compteId,
        ]);
        return redirect()->route('revenus.index', ['compteId' => $compteId]);
    }

    public function create(string $compteId) {
        return view('revenus.create', ['compteId' => $compteId]);
    }

    public function update(Request $request, string $id) {
        $revenu = Revenu::findOrFail($id);

        $revenu->update([
            'nom' => $request->nom ?? $revenu->nom,
            'description' => $request->description ?? $revenu->description,
            'montant' => $request->montant ?? $revenu->montant,
            'date_debut' => $request->date_debut ?? $revenu->date_debut,
            'frequence' => $request->frequence ?? $revenu->frequence,
            'date_fin' => $request->date_fin ?? $revenu->date_debut,
            'duree' => $request->duree ?? $revenu->duree,
            'compte_id' => $request->compte_id ?? $revenu->compte_id,
        ]);
        return redirect()->route('revenus.index', ['compteId' => $revenu->compte_id]);
    }

    public function edit(string $id) {
        $revenu = Revenu::findOrFail($id);
        return view('revenus.edit', ['revenus' => $revenu]);
    }

    public function destroy(string $id) {
        $delete = Revenu::findOrFail($id);
        $delete->deleteOrFail($id);

        return redirect()->route('revenus.index', ['compteId' => $delete->compte_id]);
    }
}
