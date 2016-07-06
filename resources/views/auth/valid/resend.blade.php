@extends('layouts.app')

@section('content')
    <h2>
        <a href="{{ url('/') }}" title="Acceuil"> <img src="/dist/svg/logo.svg" alt="Liege Hackerspace"></a>
    </h2>
    <form id="sign-in-form" method="POST" action="{{ url('/valid/resend') }}">
        {{ csrf_field() }}
            <p>Votre comte n'est pas encore valider, veyer cliquer sur le lien dans l'email</p>
            <p>Si vous ne trouver pas l'email regarder dans le dossier SPAM</p>
        @if ($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
        @endif
        <p>
            <label for="sign-in_name" class="hide">Email</label>
            <input type="text" id="name" name="name" placeholder="Nom d'utilisateur">
        </p>

        <p class="form-submit">
            <button type="submit" class="btn">Renvoyer le lien de validation</button>
        </p>
    </form>
@endsection
