<x-app-layout> <x-slot name="header"> <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> Exception </h2> </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="grid grid-cols-3 gap-4">

                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">

                        <strong>Nom</strong>
                        <p>{{ $exception->nom }}</p>

                        @if ($exception->description)
                            <p>
                                <strong>Description : </strong>
                                {{ $exception->description }}
                            </p>
                        @endif

                        <strong>Montant</strong>
                        <p>{{ $exception->montant }} €</p>

                        @if (!$exception->frequence)

                            <strong>Type</strong>
                            <p>Ponctuelle</p>

                            <strong>Date</strong>
                            <p>{{ $exception->date_debut }}</p>

                        @else

                            <strong>Type</strong>
                            <p>Récurrente</p>

                            <strong>Durée</strong>
                            <p>Tout les {{ $exception->duree }} mois</p>

                            <strong>Date de début</strong>
                            <p>{{ $exception->date_debut }}</p>

                            <strong>Date de fin</strong>
                            <p>{{ $exception->date_fin }}</p>

                        @endif

                        <div style="border-top:2px solid #d1d5db; border-bottom:2px solid #d1d5db; padding:15px 0; margin-top:25px;">

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">

                                <a href="{{ route('exceptions.edit', $exception->id) }}"
                                    style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                    Modifier l'exception
                                </a>

                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">

                                @if ($exception->depense_id)

                                    <a href="{{ route('depenses.show', $exception->depense_id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                        Retour à la dépense
                                    </a>

                                @elseif ($exception->revenu_id)

                                    <a href="{{ route('revenus.show', $exception->revenu_id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                        Retour au revenu
                                    </a>

                                @endif

                                <form method="POST" action="{{ route('exceptions.destroy', $exception->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:#dc2626; color:white; padding:10px 20px; border-radius:12px; font-weight:600; border:none; cursor:pointer;">
                                        Supprimer l'exception
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

</x-app-layout>