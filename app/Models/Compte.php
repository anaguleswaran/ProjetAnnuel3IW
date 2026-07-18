<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use HasFactory;
use App\Models\Revenu;
use App\Models\Depense;

class Compte extends Model
{


    // Ajouter tous les champs que tu veux remplir avec ::create()
    protected $fillable = [
        'nom',               // ou 'nom_court' si tu veux suivre la DB
        'description',
        'taux_remuneration',
        'taux_imposition',
        'user_id',
    ];

    
    public function revenus() {
        return $this->hasMany(Revenu::class);
    }

    public function depenses() {
        return $this->hasMany(Depense::class);
    }
}
