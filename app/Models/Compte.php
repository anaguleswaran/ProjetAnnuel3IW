<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Belongsto;

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

    public function user() {
        return $this->belongsTo(User::class);
    }
}
