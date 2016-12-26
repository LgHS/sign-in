@extends('layouts.auth')

@section('page_title')
    Connectez-vous
@endsection

@section('title')
    Connectez-vous pour administrer votre compte LgHS. <br>
    <small>Membre mais pas encore de compte ? <a href="mailto:admin@lghs.be" title="Contactez-nous">Contactez-nous</a>.</small>
@endsection

@section('content')
    <form id="sign-in-form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        @if ($errors->has('username'))
            <p class="alert alert-danger">{{ $errors->first('username') }}</p>
        @endif
        @if ($errors->has('password'))
            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
        @endif

        <div class="form-group">
            <label for="username" class="hide">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" value="{{old('username')}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="sign-in_password" class="hide">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-control">
        </div>
        <div class="checkbox">
            <label for="remember">
                <input type="checkbox" id="remember" name="remember" checked>
                Rester connecté
            </label>
        </div>
        <p class="form-submit">
            <button type="submit" class="btn btn-primary">Connectez-vous</button>
        </p>
        <p class="form-help">
            <a href="{{ url('/password/reset') }}" title="Réinitialiser votre mot de passe">
                Mots de passe perdu ?
            </a>
        </p>
        <p class="bottom-cta">
            <a href="mailto:admin@lghs.be" title="Contactez-nous">
                Membre mais pas de compte ? Contactez-nous.
            </a>
        </p>
    </form>
@endsection
