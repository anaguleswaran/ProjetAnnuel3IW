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

                    <div class="space-y-4">
                        <h1>{{$compte->nom}}</h1>

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

                    </div>
            

                        <br>
                        <br>

                        <a href="/comptes/update/{{ $compte->id }}">Modifier mon compte</a>
                        <form action='comptes/{{$compte->id}}' method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Voulez-cous supprimez ce compte ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                        <a href="{{ route('revenus', $compte->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                                            Voir les revenus
                                        </a>
                                        <a href="{{ route('revenus.create', $compte->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                                            Ajouter un revenu
                                        </a>
                                        <a href="{{ route('depenses.index', $compte->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                                            Voir les dépenses
                                        </a>
                                        <a href="{{ route('depenses.create', $compte->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                                            Ajouter une dépense
                                        </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>