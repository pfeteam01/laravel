<h1>Bonjour {{$ag->name}}</h1>
<p>Merci d'avoir choisit notre site pour l'immobilier, le site où  vous gérer tous vos biens gratuitement</p>
<hr>
<p>Voici votre lien d'activation</p>
<a href="{{url('/confirmermailagence/'.$ag->id_agence)}}">Valider mon compte</a>
