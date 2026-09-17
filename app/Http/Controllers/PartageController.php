<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Partage;
use App\Mail\PartageInvitation;

class PartageController extends Controller
{
    // Liste des partages d'un compte (vue propriétaire)
    public function index(string $compteId)
    {
        $compte = auth()->user()->comptes()->findOrFail($compteId);
        $partages = $compte->partages()->get();

        return view('partages.index', [
            'compte' => $compte,
            'partages' => $partages,
        ]);
    }

    // Formulaire d'invitation
    public function create(string $compteId)
    {
        $compte = auth()->user()->comptes()->findOrFail($compteId);

        return view('partages.create', ['compte' => $compte]);
    }

    // Envoi de l'invitation
    public function store(Request $request, string $compteId)
    {
        $compte = auth()->user()->comptes()->findOrFail($compteId);

        $request->validate([
            'email' => ['required', 'email'],
        ]);

        if ($request->email === auth()->user()->email) {
            return back()->withErrors(['email' => "Vous ne pouvez pas vous inviter vous-même."]);
        }

        $dejaPartage = $compte->partages()
            ->where('email_invite', $request->email)
            ->where('statut', '!=', 'revoque')
            ->exists();

        if ($dejaPartage) {
            return back()->withErrors(['email' => "Ce compte est déjà partagé avec cette adresse."]);
        }

        $partage = Partage::create([
            'compte_id' => $compte->id,
            'email_invite' => $request->email,
            'token' => Str::random(40),
            'statut' => 'en_attente',
        ]);

        Mail::to($request->email)->send(new PartageInvitation($partage));

        return redirect()->route('partages.index', ['compteId' => $compte->id])
            ->with('status', 'Invitation envoyée.');
    }

    // Acceptation via le lien reçu par mail (utilisateur doit être connecté)
    public function accept(string $token)
    {
        $partage = Partage::where('token', $token)
            ->where('statut', 'en_attente')
            ->firstOrFail();

        if ($partage->email_invite !== auth()->user()->email) {
            abort(403, "Cette invitation ne correspond pas à votre adresse email.");
        }

        $partage->update([
            'user_id' => auth()->id(),
            'statut' => 'accepte',
        ]);

        return redirect()->route('compte')
            ->with('status', 'Vous avez maintenant accès au compte partagé.');
    }

    // Révocation d'un partage (propriétaire uniquement)
    public function destroy(string $id)
    {
        $partage = Partage::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $compteId = $partage->compte_id;
        $partage->delete();

        return redirect()->route('partages.index', ['compteId' => $compteId])
            ->with('status', 'Partage révoqué.');
    }
}