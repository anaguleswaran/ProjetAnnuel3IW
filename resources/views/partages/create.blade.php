<x-app-layout>
    <div class="py-12 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Partager "{{ $compte->nom }}"</h1>
        <form method="POST" action="{{ route('partages.store', $compte->id) }}">
            @csrf
            <label class="block mb-2">Email de la personne à inviter</label>
            <input type="email" name="email" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;">
            @error('email') <p style="color:red;">{{ $message }}</p> @enderror
            <button type="submit" style="margin-top:12px;background:#166534;color:white;padding:10px 20px;border-radius:8px;">Envoyer l'invitation</button>
        </form>
    </div>
</x-app-layout>