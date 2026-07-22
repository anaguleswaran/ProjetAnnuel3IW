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
                        <form action="/comptes/{{$compte->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="nom">Nom du compte :</label>
                            <input type="text" id="nom" name="nom" value="{{$compte->nom}}" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black" required>
                            <br>
                            <label for="description">Description :</label>
                            <textarea type="text" id="description" name="description" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">{{$compte->description}}</textarea>
                            <br>
                            <label for="taux_remuneration">Taux de rémunération :</label>
                            <input type="number" id="taux_remuneration" name=taux_remuneration  value="{{$compte->taux_remuneration}}" step="1" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">
                            <br>
                            <label for="taux_imposition">Taux d'imposition :</label>
                            <input type="number" id="taux_imposition" name=taux_imposition value="{{$compte->taux_imposition}}" step="1" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">
                            <br>
                            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                                <button type="submit" style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px;">Modifier le compte</button>
                                <a href="{{ route('comptes.show', $compte->id) }}" style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600 text-decoration:none;">Retour au compte {{$compte->nom}}</a>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>  
