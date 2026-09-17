<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exception;
use App\Models\Depense;
use App\Models\Revenu;
use Carbon\Carbon;

class ExceptionController extends Controller
{
    public function indexDepense(string $depenseId)
    {
        $depense = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($depenseId);

        $exceptions = Exception::where('depense_id', $depense->id)->get();

        foreach ($exceptions as $exception) {
            $exception->date_debut = Carbon::parse($exception->date_debut)->format('d/m/Y');

            if ($exception->date_fin) {
                $exception->date_fin = Carbon::parse($exception->date_fin)->format('d/m/Y');
            }
        }

        return view('exceptions.index', [
            'exceptions' => $exceptions,
            'depense' => $depense,
        ]);
    }

    public function indexRevenu(string $revenuId)
    {
        $revenu = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($revenuId);

        $exceptions = Exception::where('revenu_id', $revenu->id)->get();

        foreach ($exceptions as $exception) {
            $exception->date_debut = Carbon::parse($exception->date_debut)->format('d/m/Y');

            if ($exception->date_fin) {
                $exception->date_fin = Carbon::parse($exception->date_fin)->format('d/m/Y');
            }
        }

        return view('exceptions.index', [
            'exceptions' => $exceptions,
            'revenu' => $revenu,
        ]);
    }

    public function createDepense(string $depenseId)
    {
        $depense = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($depenseId);

        return view('exceptions.create', [
            'depense' => $depense,
        ]);
    }

    public function createRevenu(string $revenuId)
    {
        $revenu = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($revenuId);

        return view('exceptions.create', [
            'revenu' => $revenu,
        ]);
    }

    public function storeDepense(Request $request, string $depenseId)
    {
        $depense = Depense::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($depenseId);

        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'duree' => ['nullable', 'integer', 'min:1'],
        ]);

        Exception::create([
            'depense_id' => $depense->id,
            'revenu_id' => null,
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence ?? false,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
        ]);

        return redirect()->route('exceptions.depense.index', [
            'depenseId' => $depense->id
        ]);
    }

    public function storeRevenu(Request $request, string $revenuId)
    {
        $revenu = Revenu::whereHas('compte', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($revenuId);

        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'duree' => ['nullable', 'integer', 'min:1'],
        ]);

        Exception::create([
            'depense_id' => null,
            'revenu_id' => $revenu->id,
            'nom' => $request->nom,
            'description' => $request->description ?? '',
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence ?? false,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
        ]);

        return redirect()->route('exceptions.revenu.index', [
            'revenuId' => $revenu->id
        ]);
    }

    public function show(string $id)
    {
        $exception = Exception::where(function ($query) {
            $query->whereHas('depense.compte', function ($query) {
                $query->where('user_id', auth()->id());
            })->orWhereHas('revenu.compte', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->findOrFail($id);

        $exception->date_debut = Carbon::parse($exception->date_debut)->format('d/m/Y');

        if ($exception->date_fin) {
            $exception->date_fin = Carbon::parse($exception->date_fin)->format('d/m/Y');
        }

        return view('exceptions.show', [
            'exception' => $exception
        ]);
    }

    public function edit(string $id)
    {
        $exception = Exception::where(function ($query) {
            $query->whereHas('depense.compte', function ($query) {
                $query->where('user_id', auth()->id());
            })->orWhereHas('revenu.compte', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->findOrFail($id);

        return view('exceptions.edit', [
            'exception' => $exception
        ]);
    }

    public function update(Request $request, string $id)
    {
        $exception = Exception::where(function ($query) {
            $query->whereHas('depense.compte', function ($query) {
                $query->where('user_id', auth()->id());
            })->orWhereHas('revenu.compte', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->findOrFail($id);

        $request->validate([
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'montant' => ['required', 'numeric', 'min:0'],
            'date_debut' => ['required', 'date'],
            'frequence' => ['required', 'boolean'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'duree' => ['nullable', 'integer', 'min:1'],
        ]);

        $exception->update([
            'nom' => $request->nom,
            'description' => $request->description ?? $exception->description,
            'montant' => $request->montant,
            'date_debut' => $request->date_debut,
            'frequence' => $request->frequence,
            'date_fin' => $request->date_fin ?? $request->date_debut,
            'duree' => $request->duree,
        ]);

        if ($exception->depense_id) {
            return redirect()->route('exceptions.depense.index', [
                'depenseId' => $exception->depense_id
            ]);
        }

        return redirect()->route('exceptions.revenu.index', [
            'revenuId' => $exception->revenu_id
        ]);
    }

    public function destroy(string $id)
    {
        $exception = Exception::where(function ($query) {
            $query->whereHas('depense.compte', function ($query) {
                $query->where('user_id', auth()->id());
            })->orWhereHas('revenu.compte', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->findOrFail($id);

        $depenseId = $exception->depense_id;
        $revenuId = $exception->revenu_id;

        $exception->deleteOrFail();

        if ($depenseId) {
            return redirect()->route('exceptions.depense.index', [
                'depenseId' => $depenseId
            ]);
        }

        return redirect()->route('exceptions.revenu.index', [
            'revenuId' => $revenuId
        ]);
    }
}
