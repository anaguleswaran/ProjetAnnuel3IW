<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compte') }}
        </h2>
    </x-slot>

<h1>All comptes</h1>
@foreach($comptes as $compte)
        <a href="/comptes/{{$compte->id}}">
            <div style="border:1px solid black; margin:10px; padding:10px;">

                <h3>{{ $compte->nom }}</h3>

                <p>
                    <strong>Description :</strong>
                    {{ $compte->description }}
                </p>

                <p>
                    <strong>Taux de rémunération :</strong>
                    {{ $compte->taux_remuneration }} %
                </p>

                <p>
                    <strong>Taux d'imposition :</strong>
                    {{ $compte->taux_imposition }} %
                </p>

                <form action='comptes/{{$compte->id}}' method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Voulez-cous supprimez ce compte ?')">
                        Supprimer
                    </button>
                </form>

            </div>
</a>

        @endforeach
 <br>
 <br>
 <a href="/comptes/create">Ajouter un compte</a>
</x-app-layout>