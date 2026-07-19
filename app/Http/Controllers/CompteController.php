<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Compte;
use Carbon\Carbon;

class CompteController extends Controller
{
    public function index() {
        $comptes = auth()->user()->comptes()->get();
        foreach ($comptes as $compte) {
            $compte->solde = $this->calculSolde($compte->id);
        }
        return view('comptes/comptes', ['comptes' => $comptes]);
    }

    public function show($id, Request $request) {
        $compte=Compte::findOrFail($id);
        $dateReference=$request->date_reference;

        $solde=$this->calculSolde($id);
        $soldeDate=null;
        if ($dateReference) {
            $soldeDate = $this->calculSolde($id, $dateReference);
        }
        return view('comptes/compte', ['compte'=> $compte, 'solde' => $solde, 'soldeDate' => $soldeDate, 'dateReference' => $dateReference]);
    }

    public function addCompte(Request $request) {
        Compte::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'taux_remuneration' => $request->taux_remuneration ?? 0,
            'taux_imposition' => $request->taux_imposition ?? 0,
            'user_id' => Auth::id(),
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
        $delete->deleteOrFail();

        return redirect('/comptes');
    }

    public function calculTotal ($elements, $dateReference = null) {

        $total = 0;
        $dateCalcul = $dateReference ?? today();

        $elements = $elements->whereDate('date_debut', '<=', $dateCalcul)
            ->get();

        foreach ($elements as $element) {

            // Element ponctuel
            if (!$element->frequence) {
                $total += $element->montant;
                continue;
            }

            $dateDebut = Carbon::parse($element->date_debut);
            $dateFin = Carbon::parse($element->date_fin);

            $limite = $dateFin->min($dateCalcul);

            $nbMois = $dateDebut->diffInMonths($limite);

            $total += (intdiv($nbMois, $element->duree) + 1) * $element->montant;
        }

        return $total;
    }

    public function calculSolde($id, $dateReference = null) {
        $compte = Compte::findOrFail($id);
        $revenuTotal = $this->calculTotal($compte->revenus(), $dateReference);
        $depenseTotal = $this->calculTotal($compte->depenses(), $dateReference);

        $solde = ($revenuTotal - $depenseTotal) * (1+$compte->taux_remuneration/100) * (1-$compte->taux_imposition/100);
        
        return round($solde,2);
    }

}
