<form action="/comptes/{{$compte->id}}" method="POST">
    @csrf
    @method('PUT')
    <label for="nom">Nom du compte :</label>
    <input type="text" id="nom" name="nom" value="{{$compte->nom}}" required>
    <br>
    <label for="description">Description :</label>
    <textarea type="text" id="description" name="description">{{$compte->description}}</textarea>
    <br>
    <label for="taux_remuneration">Taux de rémunération :</label>
    <input type="number" id="taux_remuneration" name=taux_remuneration  value="{{$compte->taux_remuneration}}" step="0.01">
    <br>
    <label for="taux_imposition">Taux d'imposition :</label>
    <input type="number" id="taux_imposition" name=taux_imposition}} value="{{$compte->taux_imposition}}" step="0.01">
    <br>
    <button type="submit">Modifier le compte</button>
</form>