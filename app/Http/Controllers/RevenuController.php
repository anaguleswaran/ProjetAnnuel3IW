<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revenu;
use Carbon\Carbon;

class RevenuController extends Controller
{
    private function compteAccessible(string $compteId): \App\Models\Compte
    {
        return \App\Models\Compte::where('id', $compteId)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereHas('partages', function ($q) {
                        $q->where('user_id', auth()->id())
                        ->where('statut', 'accepte');
                    });
            })->firstOrFail();
    }

    public function index(string $compteId) {
        // $compte = auth()->user()->comptes()->findOrFail($compteId);
        $compte = $this->compteAccessible($compteId);
        $revenus = Revenu::select('*')->where('compte_id', $compte->id)->get();

        foreach ($revenus as $revenu) {
            $revenu->date_debut = Carbon::parse($revenu->date_debut)->format('d/m/Y');
            $revenu->date_fin = Carbon::parse($revenu->date_fin)->format('d/m/Y');
        }

         return view('revenus.index', ['revenus' => $revenus, 'compteId' => $compteId, 'lectureSeule' => $compte->user_id !== auth()->id()]);
    }

    public function show(string $id) {
        // $revenus=Revenu::whereHas('compte', function ($query) {
        //     $query->where('user_id', auth()->id());
        // })->findOrFail($id);
        $revenus = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhereHas('partages', function ($q) {
                    $q->where('user_id', auth()->id())
                    ->where('statut', 'accepte');
                });
        })->findOrFail($id);

        $revenus->date_debut = Carbon::parse($revenus->date_debut)->format('d/m/Y');
        if ($revenus->date_fin) {
            $revenus->date_fin = Carbon::parse($revenus->date_fin)->format('d/m/Y');
        }
        $exceptions = $revenus->exceptions()->get();

        return view('revenus.show', [
            'revenus' => $revenus,
            'exceptions' => $exceptions,
            'lectureSeule' => $revenus->compte->user_id !== auth()->id(),
        ]);

    }

    public function store(Request $request, string $compteId) {
      
        $compte = auth()->user()->comptes()->findOrFail($compteId);

        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'duree' => ['nullable', 'integer', 'min:1'],
        ]);

        Revenu::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence ?? false,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
            'compte_id' => $compte->id,
        ]);
        return redirect()->route('revenus.index', ['compteId' => $compte->id]);
    }

    public function create(string $compteId) {
        auth()->user()->comptes()->findOrFail($compteId);
        return view('revenus.create', ['compteId' => $compteId]);
    }

    public function update(Request $request, string $id) {
        $revenu = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);
        
        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'duree' => ['nullable', 'integer', 'min:1'],
        ]);

        $revenu->update([
            'nom' => $request->nom ?? $revenu->nom,
            'description' => $request->description ?? $revenu->description,
            'montant' => $request->montant ?? $revenu->montant,
            'date_debut' => $request->date_debut ?? $revenu->date_debut,
            'frequence' => $request->frequence ?? $revenu->frequence,
            'date_fin' => $request->date_fin ?? $revenu->date_debut,
            'duree' => $request->duree ?? $revenu->duree,
            'compte_id' => $revenu->compte_id,
        ]);
        return redirect()->route('revenus.index', ['compteId' => $revenu->compte_id]);
    }

    public function edit(string $id) {
        $revenu = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);
        return view('revenus.edit', ['revenus' => $revenu]);
    }

    public function destroy(string $id) {
        $delete = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $compteId = $delete->compte_id;

        $delete->deleteOrFail();

        return redirect()->route('revenus.index', ['compteId' => $compteId]);
    }
}
