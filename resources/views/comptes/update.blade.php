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
                    <div class="space-y-4">
                        <form action="/comptes/{{$compte->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="nom">Nom du compte :</label>
                            <input type="text" id="nom" name="nom" value="{{$compte->nom}}" class="w-full rounded text-black"  style="color:black" required>
                            <br>
                            <label for="description">Description :</label>
                            <textarea type="text" id="description" name="description" class="w-full rounded text-black"  style="color:black">{{$compte->description}}</textarea>
                            <br>
                            <label for="taux_remuneration">Taux de rémunération :</label>
                            <input type="number" id="taux_remuneration" name=taux_remuneration  value="{{$compte->taux_remuneration}}" step="1" class="w-full rounded text-black"  style="color:black">
                            <br>
                            <label for="taux_imposition">Taux d'imposition :</label>
                            <input type="number" id="taux_imposition" name=taux_imposition value="{{$compte->taux_imposition}}" step="1" class="w-full rounded text-black"  style="color:black">
                            <br>
                            <button type="submit">Modifier le compte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>