<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use Carbon\Carbon;

class CompteController extends Controller
{
    public function index() {
        $comptes = Compte::all();
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
        $delete->deleteOrFail();

        return redirect('/comptes');
    }

    public function calculTotal ($elements, $dateReference = null, $mode = 'cumul') {

        $total = 0;
        $dateCalcul = $dateReference ?? today();

        $elements = $elements->whereDate('date_debut', '<=', $dateCalcul)
            ->get();

        foreach ($elements as $element) {

            // Element ponctuel
            if (!$element->frequence) {

                if ($mode === 'mois') {
                    if ($dateCalcul->isSameMonth(Carbon::parse($element->date_debut))) {
                        $total += $element->montant;
                    }
                } else {
                    $total += $element->montant;
                }
                continue;
            }

            $dateDebut = Carbon::parse($element->date_debut);
            $dateFin = Carbon::parse($element->date_fin);
            $limite = $dateFin->min($dateCalcul);

            $nbMois = $dateDebut->diffInMonths($limite);

            if ($mode === 'mois') {
                if ($nbMois % $element->duree === 0) {
                    $total += $element->montant;
                } 
            } else {
                $total += (intdiv($nbMois, $element->duree) + 1) * $element->montant;
            }
        }

        return $total;
    }

    public function calculSolde($id, $dateReference = null) {
        $compte = Compte::findOrFail($id);
        
        // $dateDebut = Carbon::parse($compte->created_at)->startOfMonth();
        $premiereDateRevenu = $compte->revenus()->min('date_debut');
        $premiereDateDepense = $compte->depenses()->min('date_debut');

        $dates = array_filter([
            $premiereDateRevenu ? Carbon::parse($premiereDateRevenu)->startOfMonth() : null,
            $premiereDateDepense ? Carbon::parse($premiereDateDepense)->startOfMonth() : null,
        ]);
        $dateDebut = min($dates);
        
        $dateFin = $dateReference ? Carbon::parse($dateReference)->endOfMonth() : today()->endOfMonth();

        $tauxMensuel = ($compte->taux_remuneration / 100) / 12;
        $tauxImposition = ($compte->taux_imposition / 100);

        $solde = 0;

        while ($dateDebut <= $dateFin) {
            $revenus = $this->calculTotal($compte->revenus(), $dateDebut, 'mois');
            $depenses = $this->calculTotal($compte->depenses(), $dateDebut, 'mois');

            $solde += $revenus - $depenses;

            if ($solde > 0 && $compte->taux_remuneration > 0) {
                $interets = $solde * $tauxMensuel;
                $impots = $interets * $tauxImposition;
                $solde += $interets - $impots;
            }

            $dateDebut->addMonth();
        }

        return round($solde, 2);
    }

}
