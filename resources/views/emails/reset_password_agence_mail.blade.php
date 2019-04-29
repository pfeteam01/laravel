<h1>Bonjour</h1>
<p>Chère agence immobilière, vous avez reçu ce mail car vous avez oublié votre mot de passe</p>
<p>Pour cela, on vous a crée ce code, veuillez l'insérer dans la page qui s'affichera en cliquant sur ce lien:</p>
<hr>
<p>Voici votre code :</p>
<p>
@if(isset($dejamodif))
    {{$dejamodif->code}}
@else
    {{$resetpass->code}}
@endif
</p>
<br>
<p>Rendez-vous sur ce lien :</p>
<br>
<a href="{{ url("/resetpasswordagencepart2") }} ">Cliquez ici svp</a>
