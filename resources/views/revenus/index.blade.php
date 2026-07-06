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

                    <a href="{{ route('revenus.create', $compteId) }}">Ajouter un Revenu</a> 
                    <br>

                    @if($revenus->isEmpty())
                        <p>Aucune revenu.</p>
                    @else
                        @foreach ($revenus as $revenu)
                                <div class="grid grid-cols-3 gap-4">                                    
                                    <a href="{{ route('revenus.show', $revenu->id) }}">
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                        <p><strong>Nom : </strong>
                                        {{ $revenu->nom }}</p>

                                        <p><strong>Description : </strong>
                                        {{ $revenu->description }}</p>

                                        @if ($revenu->frequence)
                                            <p><strong>Fréquence : </strong> ponctuel</p>
                                            <p><strong>Date de début</strong>
                                            {{ $revenu->date_debut }}</p>
                                            
                                        @else 
                                            <p><strong>Fréquence :</strong>
                                            Tout les {{ $revenu->duréé }} mois</p>
                                        @endif  

                                        <br>                           
                                            
                                        <form method="POST" action="{{ route('revenus.destroy', $revenu->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Supprimer la salle</button>
                                        </form>
                                    </div>
                                    </a>
                                    <br>
                                </div>
                            <br>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
