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

                    <form method="POST" action="{{ route('depenses.store') }}">
                        @csrf

                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="w-full rounded text-black"  style="color:black" required>
                        </div>

                        <div>
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="w-full rounded text-black"  style="color:black"></textarea>
                        </div>

                        <div>
                            <label for="montant">Montant (€)</label>
                            <input type="number" step="1" id="montant" name="montant" class="w-full rounded text-black"  style="color:black" required>
                        </div>


                        <div>
                            <label class="block mb-2">Type de depense</label>
                            <label class="mr-6">
                                <input type="radio" name="ponctuel" value="1" checked>Ponctuel
                            </label>

                            <label>
                                <input type="radio" name="ponctuel" value="0"> Récurrent
                            </label>
                        </div>

                        <div>
                            <label for="date_debut">Date de début</label>
                            <input type="date" id="date_debut" name="date_debut" class="w-full rounded text-black"  style="color:black">
                        </div>

                    
                        <div id="recurrent-fields" class="hidden space-y-4">
                            <div>
                                <label for="date_fin">Date de fin</label>
                                <input type="date" id="date_fin" name="date_fin" class="w-full rounded text-black"  style="color:black">
                            </div>

                            <div>
                                <label for="duree">Durée</label>
                                <input type="number" id="duree" name="duree" class="w-full rounded text-black"  style="color:black">
                            </div>

                            <div>
                                <label for="frequence">Fréquence</label>
                                <select id="frequence" name="frequence" class="w-full rounded text-black"  style="color:black">
                                    <option value="">Choisir...</option>
                                    <option value="1">Tous les jours</option>
                                    <option value="7">Toutes les semaines</option>
                                    <option value="30">Tous les mois</option>
                                    <option value="365">Tous les ans</option>
                                </select>
                            </div>

                        </div>

                        <button type="submit">Ajouter mon depense</button>

                    </form>
                    
                    <script>
                        const radios = document.querySelectorAll('input[name="ponctuel"]');
                        const recurrentFields = document.getElementById('recurrent-fields');

                        function toggleFields() {
                            const value = document.querySelector('input[name="ponctuel"]:checked').value;

                            if (value === "0") {
                                recurrentFields.classList.remove('hidden');
                            } else {
                                recurrentFields.classList.add('hidden');
                            }
                        }

                        radios.forEach(radio => {
                            radio.addEventListener('change', toggleFields);
                        });

                        toggleFields();
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
