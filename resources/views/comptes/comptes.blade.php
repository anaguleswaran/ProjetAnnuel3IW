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
                            <div class="grid grid-cols-3 gap-4">                        
                                <a href="/comptes/{{$compte->id}}">
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">


                                        <h1 class="text-xl font-bold mb-2"><strong>{{ $compte->nom }}</strong></h1>
                                        @if ($compte->description)
                                            <p>
                                                <strong>Description :</strong>
                                                {{ $compte->description }}
                                            </p>
                                        @endif
                                        <p>Solde : {{$compte->solde}}</p>
                                        
                                        <form action='comptes/{{$compte->id}}' method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Voulez-cous supprimez ce compte ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                        <br>
                                        <a href="{{ route('revenus.index', $compte->id) }}" style="margin-right: 235px; margin-left:105px">
                                            Voir les revenus
                                        </a>
                                        <a href="{{ route('revenus.create', $compte->id) }}" >
                                            Ajouter un revenu
                                        </a>
                                        <br><br>
                                        <a href="{{ route('depenses.index', $compte->id) }}" style="margin-right: 220px; margin-left:100px">
                                            Voir les dépenses
                                        </a>
                                        <a href="{{ route('depenses.create', $compte->id) }}" >
                                            Ajouter une dépense
                                        </a>
                                    </div>
                                </a>
                            </div>
                        @endforeach 
                    </div>
                    <br>
                    <br>
                    <a href="/comptes/create">Ajouter un compte</a>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>