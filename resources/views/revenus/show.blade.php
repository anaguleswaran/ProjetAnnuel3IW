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

                        <div class="grid grid-cols-3z gap-4">
                            
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                <strong>Nom</strong>
                                <p>{{ $revenus->nom }}</p>
                                
                                @if ($revenus->description)
                                    <p><strong>Description : </strong>
                                    {{ $revenus->description }}</p>
                                @endif

                                @if (!$revenus->frequence)
                                    <strong>Montant</strong>
                                    <p>{{ $revenus->montant }} €</p>
                                    
                                    <strong>Date de début</strong>
                                    <p>{{ $revenus->date_debut }}</p>
                                            
                                @else
                                    <strong>Durée</strong>
                                    <p>Tout les {{ $revenus->duree }} mois</p>

                                    <strong>Montant</strong>
                                    <p>{{ $revenus->montant }}</p>

                                    <strong>Date de début</strong>
                                    <p>{{ $revenus->date_debut }}</p>
                                            
                                    <strong>Date de fin</strong>
                                    <p>{{ $revenus->date_fin }}</p>
                                @endif
                                <div style="border-top:2px solid #d1d5db; border-bottom:2px solid #d1d5db; padding:15px 0; margin-top:25px;">                                    
                                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">                                        
                                        <a href="{{ route('revenus.edit', $revenus->id) }}"
                                        style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Modifier le revenu
                                        </a>
                                    </div>
                                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                                        <a href="{{ route('revenus.index', $revenus->compte_id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Retour à la liste des revenus
                                        </a>
                                        <a href="{{ route('comptes.show', $revenus->compte_id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Retour au compte
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
