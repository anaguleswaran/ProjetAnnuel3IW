<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Revenu;
use App\Models\Depense;
use App\Models\User;

class Compte extends Model
{
    use HasFactory;

    // Ajouter tous les champs que tu veux remplir avec ::create()
    protected $fillable = [
        'nom',
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

    public function user() {
        return $this->belongsTo(User::class);
    }
}
