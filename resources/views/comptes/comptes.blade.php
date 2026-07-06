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

                        @foreach($comptes as $compte)
                                <a href="/comptes/{{$compte->id}}">

                                        <h3>{{ $compte->nom }}</h3>

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

                                <form action='comptes/{{$compte->id}}' method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Voulez-cous supprimez ce compte ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </a>

                        @endforeach 
                        <br>
                        <br>
                        <a href="/comptes/create">Ajouter un compte</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>