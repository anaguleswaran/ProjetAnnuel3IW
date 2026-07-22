<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Revenu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-4">
                        <form method="POST" action="{{ route('revenus.update', $revenus->id) }}">
                                    @csrf
                                    @method('PUT')

                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" value="{{$revenus->nom}}" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black" required>
                        </div>

                        <div>
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">{{ $revenus->description }}</textarea>
                        </div>

                        <div>
                            <label for="montant">Montant (€)</label>
                            <input type="number" step="1" id="montant" name="montant" value="{{$revenus->montant}}" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black" required>
                        </div>


                        <div>
                            <label class="block mb-2">Type de revenu</label>
                            <label class="mr-6">
                                <input type="radio" name="frequence" value="0" {{ $revenus->frequence == 0 ? 'checked' : '' }}>
                                Ponctuel
                            </label>

                            <label>
                                <input type="radio" name="frequence" value="1" {{ $revenus->frequence == 1 ? 'checked' : '' }}>
                                Récurrent
                            </label>
                        </div>

                        <div>
                            <label for="date_debut">Date de début</label>
                            <input type="date" id="date_debut" name="date_debut" value="{{$revenus->date_debut}}" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">
                        </div>

                    
                        <div id="recurrent-fields" class="hidden space-y-4">
                            <div>
                                <label for="date_fin">Date de fin</label>
                                <input type="date" id="date_fin" name="date_fin" value="{{$revenus->date_fin}}" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">
                            </div>

                            <div>
                                <label for="duree">Durée</label>
                                <input type="number" id="duree" name="duree" value="{{$revenus->duree}}" class="w-full rounded-xl border-gray-300 p-3 text-black"  style="color:black">
                            </div>

                        </div>
                          
                                    <div style="display: flex; justify-content:space-between; margin-top: 20px;">                                        
                                        <button type="submit"
                                        style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Modifier mon revenu
                                        </button>
                                        <a href="{{ route('revenus.show', $revenus->id) }}"
                                        style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">
                                            Retour au revenu {{$revenus->nom}}
                                        </a>
                                    </div>
                                </form>

                    </div>

                    <script>
                        const radios = document.querySelectorAll('input[name="frequence"]');
                        const recurrentFields = document.getElementById('recurrent-fields');

                        function toggleFields() {
                            const value = document.querySelector('input[name="frequence"]:checked').value;

                            if (value === "0") {
                                recurrentFields.classList.add('hidden');
                            } else {
                                recurrentFields.classList.remove('hidden');
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
