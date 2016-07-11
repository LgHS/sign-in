@extends('layouts.auth')

@section('page_title')
    Créez votre compte
@endsection

@section('title')
    Créez votre compte LgHS ! <br>
    <small>Déjà un compte ? <a href="{{ url('/login') }}" title="Connectez-vous">Connectez-vous</a>.</small>
@endsection

@section('content')
    <form id="sign-in-form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        @if ($errors->has('name'))
            <p class="alert alert-danger">{{ $errors->first('name') }}</p>
        @endif
        @if ($errors->has('email'))
            <p class="alert alert-danger">{{ $errors->first('email') }}</p>
        @endif
        @if ($errors->has('password'))
            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
        @endif
        @if ($errors->has('password_confirmation'))
            <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
        @endif
        <div class="form-group">
            <label for="sign-in_name" class="hide">Nom d'utilisateur</label>
            <input type="text" id="name" name="name" placeholder="Nom d'utilisateur"
                   class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="sign-in_email" class="hide">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Email"
                   class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="sign-in_password" class="hide">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-control">
        </div>
        <div class="form-group">
            <label for="sign-in_password_confirmation" class="hide">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe" class="form-control">
        </div>

        <p class="form-submit">
            <button type="submit" class="btn btn-primary">Créez votre compte</button>
        </p>

        <p class="bottom-cta">
            <a href="{{ url('/login') }}" title="Connectez-vous">
                Déjà un compte ? Connectez-vous.
            </a>
        </p>
    </form>
@endsection
