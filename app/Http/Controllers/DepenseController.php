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
    // public function index(string $compteId)
    // {
    //     $compte = auth()->user()->comptes()->findOrFail($compteId);
    //     $depenses = Depense::select('*')->where('compte_id', $compte->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //     foreach ($depenses as $depense) {
    //         $depense->date_debut = Carbon::parse($depense->date_debut)->format('d/m/Y');
    //         $depense->date_fin = Carbon::parse($depense->date_fin)->format('d/m/Y');
    //     }
    //      return view('depenses.index', ['depenses' => $depenses, 'compteId' => $compteId]);
    // }

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

    public function index(Request $request, string $compteId)
{
    // $compte = auth()->user()->comptes()->findOrFail($compteId);
    $compte = $this->compteAccessible($compteId);

    $query = Depense::where('compte_id', $compte->id);

    if ($request->filled('recherche')) {
        $query->where('nom', 'like', '%' . $request->recherche . '%');
    }

    $depenses = $query->get();

    foreach ($depenses as $depense) {
        $depense->date_debut = Carbon::parse($depense->date_debut)->format('d/m/Y');
        $depense->date_fin = Carbon::parse($depense->date_fin)->format('d/m/Y');
    }

    return view('depenses.index', [
        'depenses' => $depenses,
        'compteId' => $compteId,
        'recherche' => $request->recherche,
        'lectureSeule' => $compte->user_id !== auth()->id()
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $compteId)
    {
        auth()->user()->comptes()->findOrFail($compteId);
        return view('depenses.create', ['compteId' => $compteId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $compteId)
    {
        $compte = auth()->user()->comptes()->findOrFail($compteId);
      
        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['nullable', 'required_if:frequence,1', 'date', 'after_or_equal:date_debut'],
            'duree' => ['nullable', 'required_if:frequence,1', 'integer', 'min:1'],
        ]);

        Depense::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence ?? false,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
            'compte_id' => $compte->id,
        ]);
        return redirect()->route('depenses.index', ['compteId' => $compte->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $depenses=Depense::whereHas('compte', function ($query) {
        //     $query->where('user_id', auth()->id());
        // })->findOrFail($id);
        $depenses = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhereHas('partages', function ($q) {
                    $q->where('user_id', auth()->id())
                    ->where('statut', 'accepte');
                });
        })->findOrFail($id);

        $depenses->date_debut = Carbon::parse($depenses->date_debut)->format('d/m/Y');
        if ($depenses->date_fin) {
            $depenses->date_fin = Carbon::parse($depenses->date_fin)->format('d/m/Y');
        }
        $exceptions = $depenses->exceptions()->get();

        return view('depenses.show', [
            'depenses' => $depenses,
            'exceptions' => $exceptions,
            'lectureSeule' => $depenses->compte->user_id !== auth()->id()
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depense = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);
        return view('depenses.edit', ['depenses' => $depense]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $depense = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['required_if:frequence,1', 'date', 'after_or_equal:date_debut'],
            'duree' => ['required_if:frequence,1', 'integer', 'min:1'],
        ]);

        $depense->update([
            'nom' => $request->nom ?? $depense->nom,
            'description' => $request->description ?? $depense->description,
            'montant' => $request->montant ?? $depense->montant,
            'date_debut' => $request->date_debut ?? $depense->date_debut,
            'frequence' => $request->frequence ?? $depense->frequence,
            'date_fin' => $request->date_fin ?? $depense->date_debut,
            'duree' => $request->duree ?? $depense->duree,
            'compte_id' => $depense->compte_id,
        ]);
        return redirect()->route('depenses.index', ['compteId' => $depense->compte_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $delete = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);
        $compteId = $delete->compte_id;
        $delete->deleteOrFail();

        return redirect()->route('depenses.index', ['compteId' => $compteId]);
    }
}
