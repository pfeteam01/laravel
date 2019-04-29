<h1>Bonjour {{$id_prop_annonce_Objet->username ?? $id_prop_annonce_Objet->name}}</h1>
<p>Un visiteur ou un abonné sur notre s'est intéréssé à l'une de vos annonces.</p>
<hr>
<!-- Les infos ta3 l'annonce -->
<p>{{$typeBien}}</p>
<p>{{$typeAction}}</p>
<hr>
<p>Vous pouvez communiquer avec lui car il vous a laissé son email et son tel.</p>
<hr>
<p>Son username est : {{$myUser}}</p>
<p>{{$res->mail}}</p>
<p>{{$res->tel}}</p>
<p>{{$res->message}}</p>
<hr>
<p>Nous espérons vraiment que vous trouviez votre bonheur et concluer une très belle affaire avec lui.</p>
<hr>
<p>SVP, si vous vous etes mis d'accord et que l'annonce n'est plus disponible, nous vous seront très reconnaissant de bien voiloir désactiver votre annonce ou bien modifier sa date de disponibilité afin que d'autres users ne viennent pas s'interessé à elle.</p>
<hr>
<p>Merci encore une fois.</p>
<hr>
<p>Voici un lien qui va vou enmener vers la modification de votre annonce (il faut que vous soyaez connecté !!!!).</p>
<a href="{{url("/edit/{$annonce->id_annonce}")}}">Aller vers la modification de l'annonce en question</a>
<img src="{{$message->embed($path)}}" alt="">
<hr>
