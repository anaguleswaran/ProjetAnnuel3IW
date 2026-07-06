<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Revenu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-3 gap-4">
                            
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                <strong>Nom</strong>
                                <p>{{ $revenus->nom }}</p>

                                <strong>Description</strong>
                                <p>{{ $revenus->description }}</p>

                                @if ($revenus->ponctuel)
                                    <strong>Montant</strong>
                                    <p>{{ $revenus->montant }} €</p>
                                    
                                    <strong>Date de début</strong>
                                    <p>{{ $revenus->montant }}</p>
                                            
                                @else 
                                    <strong>Fréquence</strong>
                                    <p>Tout les {{ $revenus->frequence }} mois</p>
                                        
                                    <strong>Durée</strong>
                                    <p>{{ $revenus->duree }}</p>

                                    <strong>Montant</strong>
                                    <p>{{ $revenus->montant }}</p>

                                    <strong>Date de début</strong>
                                    <p>{{ $revenus->date_debut }}</p>
                                            
                                    <strong>Date de fin</strong>
                                    <p>{{ $revenus->date_fin }}</p>
                                @endif
                                <br>                           
                                <form method="POST" action="{{ route('revenus.destroy', $revenus->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer la salle</button>
                                </form>
                                <a href="{{ route('revenus.edit', $revenus->id) }}">Modifier mon revenu</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
