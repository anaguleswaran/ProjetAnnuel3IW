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
                    <form method="GET" action="{{ route('depenses.index', $compteId) }}">
                        <input type="text" name="recherche" value="{{ $recherche ?? '' }}" placeholder="Rechercher une dépense..." style="width:220px; padding:10px 14px; border:1px solid #d1d5db; border-radius:12px; font-size:14px; color:#111827; margin-bottom:40px;">
                        <button type="submit">Recherche</button>
                    </form>


                    @if($depenses->isEmpty())
                        <p>Aucune depense.</p>
                    @else
                        @foreach ($depenses as $depense)
                            <div class="grid gap-4">
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
                                    @if(!$lectureSeule)                           
                                        <form method="POST" action="{{ route('depenses.destroy', $depense->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            style="border: 2px solid #dc2626; color: #dc2626; border-radius: 12px; padding: 6px 10px; cursor: pointer; margin-top: 10px; margin-right: 5px">
                                            Supprimer ma dépense</button>
                                        </form> 
                                    @endif  
                                </div>
                                </a>
                                <br>
                            </div>
                        @endforeach
                        
                    @endif
                    <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                        @if(!$lectureSeule)
                            <a href="{{ route('depenses.create', $compteId) }}" style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px;">
                                + Ajouter une dépense
                            </a> 
                        @endif
                        <a href="{{ route('comptes.show', $compteId) }}" style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600 text-decoration:none;">
                            Retour au compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
