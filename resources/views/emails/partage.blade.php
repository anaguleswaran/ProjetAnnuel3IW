<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif;">
    <p>Bonjour,</p>
    <p>
        {{ $partage->compte->user->name }} vous invite à consulter le compte
        <strong>{{ $partage->compte->nom }}</strong> sur Budgie.
    </p>
    <p>
        <a href="{{ $lien }}" style="background:#166534;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
            Accepter l'invitation
        </a>
    </p>
    <p>Si vous n'avez pas de compte Budgie, vous devrez d'abord en créer un avec cette adresse email : {{ $partage->email_invite }}</p>
</body>
</html>