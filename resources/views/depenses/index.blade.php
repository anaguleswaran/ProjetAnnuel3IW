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

                    @if($depenses->isEmpty())
                        <p>Aucune depense.</p>
                    @else
                        @foreach ($depenses as $depense)
                            <div class="grid grid-cols-3 gap-4" mb-4>
                                <a href="{{ route('depenses.show', $depense->id) }}">
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                    <p><strong>Nom : </strong>
                                    {{ $depense->nom }}</p>

                                    <p><strong>Montant : </strong>
                                    {{ $depense->montant }} €</p>
                                    
                                    <p><strong>Date de début</strong>
                                    {{ $depense->date_debut }}</p>

                                    @if (!$depense->frequence)
                                        <p><strong>Fréquence : </strong> ponctuel</p>                                            
                                    @else 
                                        <p><strong>Fréquence :</strong>
                                        Tout les {{ $depense->duree }} mois</p>
                                    @endif                                

                                    <br>                            
                                    <form method="POST" action="{{ route('depenses.destroy', $depense->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        style="border: 2px solid #dc2626; color: #dc2626; border-radius: 12px; padding: 6px 10px; cursor: pointer; margin-top: 10px; margin-right: 5px">
                                        Supprimer ma dépense</button>
                                    </form>   
                                </div>
                                </a>
                                <br>
                            </div>
                        @endforeach
                        
                    @endif
                    <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                        <a href="{{ route('depenses.create', $compteId) }}" style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px;">
                            + Ajouter une dépense
                        </a> 
                        <a href="{{ route('comptes.show', $compteId) }}" style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600 text-decoration:none;">
                            Retour au compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
