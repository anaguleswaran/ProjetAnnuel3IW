<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Compte;
use App\Models\User;

class Partage extends Model
{
    protected $fillable = [
        'compte_id',
        'user_id',
        'email_invite',
        'token',
        'statut',
    ];

    public function compte(): BelongsTo
    {
        return $this->belongsTo(Compte::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}