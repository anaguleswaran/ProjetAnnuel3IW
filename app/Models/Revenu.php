<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Revenu extends Model
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
