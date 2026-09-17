<x-app-layout>
    <div class="py-12 max-w-2xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Partages de "{{ $compte->nom }}"</h1>

        @if(session('status'))
            <p style="color:green;">{{ session('status') }}</p>
        @endif

        <a href="{{ route('partages.create', $compte->id) }}" style="color:#166534;font-weight:700;">+ Inviter quelqu'un</a>

        <ul style="margin-top:20px;">
            @foreach($partages as $partage)
                <li style="display:flex;justify-content:space-between;border-bottom:1px solid #e5e7eb;padding:8px 0;">
                    <span>{{ $partage->email_invite }} — {{ $partage->statut === 'accepte' ? 'Accepté' : 'En attente' }}</span>
                    <form method="POST" action="{{ route('partages.destroy', $partage->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:#dc2626;">Révoquer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>