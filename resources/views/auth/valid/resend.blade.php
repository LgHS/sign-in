@extends('layouts.auth')

@section('content')
    <form id="sign-in-form" method="POST" action="{{ url('/valid/resend') }}">
        {{ csrf_field() }}
        <p>
            <strong>
                Votre compte n'est pas encore validé, veuillez cliquer sur le lien dans l'email
                que vous avez reçu.
            </strong>
        </p>
        <p>
            Si vous ne voyez rien, vérifiez votre dossier spam. Sinon vous pouvez retenter l'envoi
            d'un e-mail :
        </p>
        @if ($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
        @endif
        <div class="form-group">
            <label for="sign-in_name" class="hide">Nom d'utilisateur</label>
            <input type="text" id="name" name="name" placeholder="Nom d'utilisateur" class="form-control">
        </div>

        <p class="form-submit">
            <button type="submit" class="btn btn-primary">Renvoyer le lien de validation</button>
        </p>
    </form>
@endsection
