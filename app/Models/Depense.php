<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Compte;

class Depense extends Model
{
    protected $fillable = [
        'nom', 
        'description',
        'duree',
        'frequence',
        'montant',
        'date_debut',
        'date_fin',        
        'compte_id'
    ];

    public function compte() {
        return $this->belongsTo(Compte::class);
    }
}
