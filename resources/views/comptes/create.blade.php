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

                        <form action="/comptes" method="POST">
                            @csrf
                            
                            <label for="nom">Nom du compte :</label>
                            <input type="text" id="nom" name="nom" class="w-full rounded text-black" style="color: black" required>
                            <br>
                            <label for="description">Description :</label>
                            <textarea id="description" name="description" class="w-full rounded text-black" style="color: black"></textarea>
                            <br>
                            <label for="taux_remuneration">Taux de rémunération :</label>
                            <input type="number" id="taux_remuneration" name="taux_remuneration" step="0.01" class="w-full rounded text-black" style="color: black">
                            <br>
                            <label for="taux_imposition">Taux d'imposition :</label>
                            <input type="number" id="taux_imposition" name="taux_imposition" step="0.01" class="w-full rounded text-black" style="color: black">
                            <br>
                            <button type="submit">Ajouter le compte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>    
