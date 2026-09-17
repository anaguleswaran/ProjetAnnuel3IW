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

                        <div class="grid gap-4">
                            
                            <h1 class="text-xl font-bold mb-2"><strong>{{$compte->nom}}</strong></h1>

                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">

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

                                <p>
                                    <strong>Solde actuel :</strong>
                                    {{ $solde }} €
                                </p>

                                <br>

                                <form method="GET" action="{{ url('/comptes/' . $compte->id) }}">

                                    <label class="block mb-2">Calculer le solde à une date donnée</label>

                                    <input type="date" name="date_reference" value="{{ $dateReference }}" style="width:220px; padding:10px 14px; border:1px solid #d1d5db; border-radius:12px; font-size:14px; color:#111827;">
                                    <button type="submit">Calculer le solde</button>

                                </form>

                                @if($soldeDate !== null)

                                    <div>
                                        <p style="font-size:14px; font-weight:600; color:#374151; margin-bottom:10px;">
                                            <strong>Solde au {{ $dateReference }} :</strong>
                                            {{ $soldeDate }} €
                                        </p>

                                    </div>

                                @endif

                                <div style="border-top:2px solid #d1d5db; border-bottom:2px solid #d1d5db; padding:13px 0; margin-top:20px;">
                                    <div style="display:flex; justify-content:space-between; align-items:center;  padding:5px; margin-top:8px;">
                                        <a href="{{ route('revenus.index', $compte->id) }}" style=" border:2px solid #166534; color:#166534; border-radius:12px; padding:10px 20px; font-weight:600; text-decoration:none;">
                                            Voir les revenus
                                        </a>
                                        @if(!$lectureSeule)
                                            <a href="{{ route('revenus.create', $compte->id) }}" style="color:#166534; font-weight:700; text-decoration:none;">
                                                + Ajouter un revenu
                                            </a>
                                        @endif
                                    </div>
                                    <div style="display:flex; justify-content:space-between; align-items:center; padding:6px; margin-top:8px;">
                                        <a href="{{ route('depenses.index', $compte->id) }}" style=" border:2px solid #166534; color:#166534; border-radius:12px; padding:10px 20px; font-weight:600; text-decoration:none;">
                                            Voir les dépenses
                                        </a>
                                        @if(!$lectureSeule)
                                            <a href="{{ route('depenses.create', $compte->id) }}" style="color:#166534; font-weight:700; text-decoration:none;">
                                                + Ajouter une dépense
                                            </a>
                                        @endif
                                    </div>

                                    @if($lectureSeule)
                                        <p style="color:#b45309;font-weight:600;margin-top:10px;">Lecture seule — compte partagé</p>
                                    @else
                                        <div style="display:flex; justify-content: space-between; margin-top: 40px;">
                                            <a href="/comptes/update/{{ $compte->id }}" style="background:#2563eb; color:white; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">Modifier le compte</a>
                                            <a href="/comptes" style="border:2px solid #374151; color:#374151; padding:10px 20px; border-radius:12px; font-weight:600; text-decoration:none;">Retour à la liste des comptes</a>
                                        </div>
                                        <div style="margin-top:15px;">
                                            <a href="{{ route('partages.index', $compte->id) }}" style="color:#2563eb; font-weight:600; text-decoration:none;">Gérer le partage</a>
                                        </div>
                                    @endif
                                </div>
                                @if(!$lectureSeule)
                                    <form action='/comptes/{{$compte->id}}' method="POST" style="margin-top: 20px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: 2px solid #dc2626; color: #dc2626; border-radius: 12px; padding: 10px 20px; font-weight: 600; background: white; cursor: pointer;">Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>