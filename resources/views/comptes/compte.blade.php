<h1>{{$compte->nom}}</h1>


            <div style="border:1px solid black; margin:10px; padding:10px;">

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

            </div>

 <br>
 <br>

 <a href="/comptes/update/{{ $compte->id }}">Modifier mon compte</a>