@extends('layouts.auth')

@section('page_title')
    Connectez-vous
@endsection

@section('title')
    Connectez-vous pour administrer votre compte LgHS. <br>
    <small>Pas encore de compte ? <a href="{{ url('/register') }}" title="Créez votre compte">Créez en un</a>.</small>
@endsection

@section('content')
    <form id="sign-in-form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        @if ($errors->has('name'))
            <p class="alert alert-danger">{{ $errors->first('name') }}</p>
        @endif
        @if ($errors->has('password'))
            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
        @endif

        <div class="form-group">
            <label for="sign-in_name" class="hide">Nom d'utilisateur</label>
            <input type="text" id="name" name="name" placeholder="Nom d'utilisateur" class="form-control">
        </div>
        <div class="form-group">
            <label for="sign-in_password" class="hide">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-control">
        </div>
        <p class="form-submit">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </p>
        <p class="form-help">
            <a href="{{ url('/password/reset') }}" title="Recover your account">
                Mots de passe perdu ?
            </a>
        </p>
        <p class="bottom-cta">
            <a href="{{ url('/register') }}" title="Register an account">
                Pas de compte ? Créez-en un.
            </a>
        </p>
    </form>
@endsection
