<form action="/comptes" method="POST">
    @csrf
    
    <label for="nom">Nom du compte :</label>
    <input type="text" id="nom" name="nom" required>
    <br>
    <label for="description">Description :</label>
    <textarea id="description" name="description"></textarea>
    <br>
    <label for="taux_remuneration">Taux de rémunération :</label>
    <input type="number" id="taux_remuneration" name="taux_remuneration" step="0.01">
    <br>
    <label for="taux_imposition">Taux d'imposition :</label>
    <input type="number" id="taux_imposition" name="taux_imposition" step="0.01">
    <br>
    <button type="submit">Ajouter le compte</button>
</form>