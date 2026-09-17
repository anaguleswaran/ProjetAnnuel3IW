<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Depense;
use App\Models\Revenu;



class Exception extends Model
{
    use HasFactory;

    protected $fillable = [
        'depense_id',
        'revenu_id',
        'nom',
        'description',
        'montant',
        'date_debut',
        'frequence',
        'date_fin',
        'duree',
    ];

    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }

    public function revenu()
    {
        return $this->belongsTo(Revenu::class);
    }
}
