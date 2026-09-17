<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Compte;
use App\Models\Exception;

class Revenu extends Model
{
    use HasFactory;
    
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

    public function exceptions()
    {
        return $this->hasMany(Exception::class);
    }

}
