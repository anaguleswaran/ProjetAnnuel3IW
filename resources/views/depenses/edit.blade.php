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
                        <form method="POST" action="{{ route('depenses.update', $depenses->id) }}">
                                    @csrf
                                    @method('PUT')

                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" value="{{$depenses->nom}}" class="w-full rounded text-black"  style="color:black" required>
                        </div>

                        <div>
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="w-full rounded text-black"  style="color:black">{{ $depenses->description }}</textarea>
                        </div>

                        <div>
                            <label for="montant">Montant (€)</label>
                            <input type="number" step="1" id="montant" name="montant" value="{{$depenses->montant}}" class="w-full rounded text-black"  style="color:black" required>
                        </div>


                        <div>
                            <label class="block mb-2">Type de depense</label>
                            <label class="mr-6">
                                <input type="radio" name="ponctuel" value="1"
                                    {{ $depenses->ponctuel == 1 ? 'checked' : '' }}>
                                Ponctuel
                            </label>

                            <label>
                                <input type="radio" name="ponctuel" value="0"
                                    {{ $depenses->ponctuel == 0 ? 'checked' : '' }}>
                                Récurrent
                            </label>
                        </div>

                        <div>
                            <label for="date_debut">Date de début</label>
                            <input type="date" id="date_debut" name="date_debut" value="{{$depenses->date_debut}}" class="w-full rounded text-black"  style="color:black">
                        </div>

                    
                        <div id="recurrent-fields" class="hidden space-y-4">
                            <div>
                                <label for="date_fin">Date de fin</label>
                                <input type="date" id="date_fin" name="date_fin" value="{{$depenses->date_fin}}" class="w-full rounded text-black"  style="color:black">
                            </div>

                            <div>
                                <label for="duree">Durée</label>
                                <input type="number" id="duree" name="duree" value="{{$depenses->duree}}" class="w-full rounded text-black"  style="color:black">
                            </div>

                            <div>
                                <label for="frequence">Fréquence</label>
                                <select id="frequence" name="frequence" class="w-full rounded text-black"  style="color:black">
                                    <option value="">Choisir...</option>
                                    <option value="1" {{ $depenses->frequence == 1 ? 'selected' : '' }}>Tous les jours</option>
                                    <option value="7" {{ $depenses->frequence == 7 ? 'selected' : '' }}>Toutes les semaines</option>
                                    <option value="30" {{ $depenses->frequence == 30 ? 'selected' : '' }}>Tous les mois</option>
                                    <option value="365" {{ $depenses->frequence == 365 ? 'selected' : '' }}>Tous les ans</option>
                                </select>
                            </div>

                        </div>
                          
                                
                                    <button type="submit">Modifier mon depense</button>
                                </form>

                    </div>

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
