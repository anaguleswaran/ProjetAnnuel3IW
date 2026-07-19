<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-3 gap-4">
                            
                            <h1 class="text-xl font-bold mb-2"><strong>{{$compte->nom}}</strong></h1>

                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">

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

                                <p>
                                    <strong>Solde actuel :</strong>
                                    {{ $solde }} €
                                </p>

                                <br>

                                <form method="GET" action="{{ url('/comptes/' . $compte->id) }}">

                                    <label class="block mb-2">Calculer le solde à une date donnée</label>

                                    <input type="date" name="date_reference" value="{{ $dateReference }}" class="rounded" style="color: black">
                                    <button type="submit">Calculer le solde</button>

                                </form>

                                @if($soldeDate !== null)

                                    <div class="mt-6">
                                        <p>
                                            <strong>Solde au {{ $dateReference }} :</strong>
                                            {{ $soldeDate }} €
                                        </p>

                                    </div>

                                @endif

                                                

                                <br>
                                <br>
                                <form action='/comptes/{{$compte->id}}' method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" >Supprimer</button>
                                </form>
                                <br>
                                <a href="{{ route('revenus.index', $compte->id) }}" style="margin-right: 235px; margin-left:105px">
                                            Voir les revenus
                                        </a>
                                        <a href="{{ route('revenus.create', $compte->id) }}" >
                                            Ajouter un revenu
                                        </a>
                                        <br><br>
                                        <a href="{{ route('depenses.index', $compte->id) }}" style="margin-right: 220px; margin-left:100px">
                                            Voir les dépenses
                                        </a>
                                        <a href="{{ route('depenses.create', $compte->id) }}" >
                                            Ajouter une dépense
                                        </a>
                                    <br><br>

                                <a href="/comptes/update/{{ $compte->id }}">Modifier le compte</a><br>
                                <a href="/comptes">Retour à la liste des comptes</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>