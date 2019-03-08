<h1>Bonjour {{$user->email}}</h1>
<p>Merci d'avoir choisit notre site pour l'immobilier, le site où  vous gérer tous vos biens gratuitement</p>
<hr>
<p>Voici votre lien d'activation</p>
<a href="{{ url("/confirm/{$user->id}/{$user->validation_token}") }} ">Valider mon compte</a>