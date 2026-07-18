<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dépense
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-3 gap-4">
                            
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                <strong>Nom</strong>
                                <p>{{ $depenses->nom }}</p>
                                
                                @if ($depenses->description)
                                    <p><strong>Description : </strong>
                                    {{ $depenses->description }}</p>
                                @endif

                                @if (!$depenses->frequence)
                                    <strong>Montant</strong>
                                    <p>{{ $depenses->montant }} €</p>
                                    
                                    <strong>Date de début</strong>
                                    <p>{{ $depenses->date_debut }}</p>
                                            
                                @else                                        
                                    <strong>Durée</strong>
                                    <p>Tout les {{ $depenses->duree }} mois</p>

                                    <strong>Montant</strong>
                                    <p>{{ $depenses->montant }}</p>

                                    <strong>Date de début</strong>
                                    <p>{{ $depenses->date_debut }}</p>
                                            
                                    <strong>Date de fin</strong>
                                    <p>{{ $depenses->date_fin }}</p>
                                @endif
                                <br>                           
                                <form method="POST" action="{{ route('depenses.destroy', $depenses->id, $depenses->compte_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer la dépense</button>
                                </form>
                                <a href="{{ route('depenses.edit', $depenses->id, $depenses->compte_id) }}">Modifier la dépense</a><br><br>
                                <a href="{{ route('depenses.index', $depenses->compte_id) }}">Retour à la liste des dépense</a><br>
                                <a href="{{ route('comptes.show', $depenses->compte_id) }}">Retour au compte</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
