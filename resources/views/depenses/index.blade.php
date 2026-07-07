<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            depense
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href='/depenses/create'>Ajouter une Depense</a> 
                    <br>

                    @if($depenses->isEmpty())
                        <p>Aucune depense.</p>
                    @else
                        @foreach ($depenses as $depense)
                            <div class="grid grid-cols-3 gap-4">
                                <a href="{{ route('depenses.update', $depense->id) }}">
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                    <strong>Nom</strong>
                                    <p>{{ $depense->nom }}</p>

                                    <strong>Description</strong>
                                    <p>{{ $depense->description }}</p>

                                    @if ($depense->ponctuel)
                                        <strong>Montant</strong>
                                        <p>{{ $depense->montant }} €</p>
                                            
                                        <strong>Date de début</strong>
                                        <p>{{ $depense->date_debut }}</p>
                                            
                                    @else 
                                        <strong>Fréquence</strong>
                                        <p>Tout les {{ $depense->frequence }} mois</p>
                                        
                                        <strong>Durée</strong>
                                        <p>{{ $depense->duree }}</p>

                                        <strong>Montant</strong>
                                        <p>{{ $depense->montant }}</p>

                                        <strong>Date de début</strong>
                                        <p>{{ $depense->date_debut }}</p>
                                            
                                        <strong>Date de fin</strong>
                                        <p>{{ $depense->date_fin }}</p>
                                    @endif                                

                                    <br>                            
                                    <form method="POST" action="{{ route('depenses.destroy', $depense->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Supprimer la salle</button>
                                    </form>   
                                </div>
                                </a>
                                <br>
                            </div>
                        @endforeach
                        
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
