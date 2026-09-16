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
                                        <p>Solde : {{$compte->solde}} €</p>
                                        
                                        <form action='comptes/{{$compte->id}}' method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Voulez-cous supprimez ce compte ?')"
                                            style="border: 2px solid #dc2626; color: #dc2626; border-radius: 12px; padding: 6px 10px; cursor: pointer; margin-top: 10px; margin-right: 5px">
                                                Supprimer le compte
                                            </button>
                                        </form>                                        
                                    </div>
                                </a>
                            </div>
                            <br>
                        @endforeach 
                    </div>
                    <a href="/comptes/create" style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px; margin-top: 30px">+ Ajouter un compte</a>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>