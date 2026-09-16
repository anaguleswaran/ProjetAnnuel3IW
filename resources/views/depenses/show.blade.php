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
                                <div style="border-top:2px solid #d1d5db; border-bottom:2px solid #d1d5db; padding:15px 0; margin-top:25px;">                                    
                                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">                                        
                                        <a href="{{ route('depenses.edit', $depenses->id, $depenses->compte_id) }}"
                                        style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Modifier la dépense
                                        </a>
                                    </div>
                                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                                        <a href="{{ route('depenses.index', $depenses->compte_id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Retour à la liste des dépense
                                        </a>
                                        <a href="{{ route('comptes.show', $depenses->compte_id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Retour au compte
                                        </a>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('depenses.destroy', $depenses->id, $depenses->compte_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    style="border: 2px solid #dc2626; color: #dc2626; border-radius: 12px; padding: 6px 10px; cursor: pointer; margin-top: 10px; margin-right: 5px">
                                        Supprimer la dépense
                                    </button>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
