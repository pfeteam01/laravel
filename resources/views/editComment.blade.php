<h1>Modifier commentaire</h1>
@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row justify-content-center">
    @if (Auth::guard('agence') || Auth::user() )
        <form method="POST" action="{{url('/updateComment/'.$id)}}">
            {{csrf_field()}}
            <div class="form-group">
                <label>Commentaire</label><br>
                <textarea name="body_comment" rows="8" cols="45" >{{$comment}}</textarea> <br>
            </div>
            <input type="submit" name="valider">
        </form>
    @else
        <a href="{{ url('/login') }}">veuillez vous Conncter afin de publier votre annonce </a>
    @endif
</div>
