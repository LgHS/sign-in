@extends('layouts.app')

@section('content')
    <h2>
        <a href="{{ url('/') }}" title="Acceuil"> <img src="/dist/svg/logo.svg" alt="Liege Hackerspace"></a>
    </h2>
    <form id="sign-in-form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        @if ($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
        @endif
        @if ($errors->has('password'))
            <p>{{ $errors->first('password') }}</p>
        @endif
        <p>
            <label for="sign-in_name" class="hide">Nom d'utilisateur</label>
            <input type="text" id="name" name="name" placeholder="Nom d'utilisateur">
        </p>
        <p>
            <label for="sign-in_password" class="hide">Mots de passe</label>
            <input type="password" id="password" name="password" placeholder="Mots de passe">
        </p>
        <p class="form-submit">
            <button type="submit" class="btn">Se connecter</button>
        </p>
        <p class="form-help">
            <a href="{{ url('/password/reset') }}" title="Recover your account">
                Mots de passe perdu ?
            </a>
        </p>
        <p class="bottom-cta">
            <a href="{{ url('/register') }}" title="Register an account">
                Pas de comte ? S'enregistrer
            </a>
        </p>
    </form>
@endsection
