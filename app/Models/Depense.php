<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = [
        'nom', 
        'description',
        'duree',
        'ponctuel',
        'frequence',
        'montant',
        'date_debut',
        'date_fin',        
        'compte_id'
    ];
}
