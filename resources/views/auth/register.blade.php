@extends('layouts.app')

@section('content')
    <h2>
        <a href="{{ url('/') }}" title="Acceuil"> <img src="/dist/svg/logo.svg" alt="Liege Hackerspace"></a>
    </h2>
    <form id="sign-in-form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        @if ($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
        @endif
        @if ($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
        @endif
        @if ($errors->has('password'))
            <p>{{ $errors->first('password') }}</p>
        @endif
        @if ($errors->has('password_confirmation'))
            <p>{{ $errors->first('password_confirmation') }}</p>
        @endif
        <p>
            <label for="sign-in_name" class="hide">Nom d'utilisateur</label>
            <input type="text" id="name" name="name" placeholder="Nom d'utilisateur">
        </p>
            <label for="sign-in_email" class="hide">Email</label>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="sign-in_password" class="hide">Mots de passe</label>
            <input type="password" id="password" name="password" placeholder="Mots de passe">
        </p>
        <p>
            <label for="sign-in_password_confirmation" class="hide">Confiemr le mots de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confiemr le mots de passe">
        </p>
        <p class="form-submit">
            <button type="submit" class="btn">S'enregister</button>
        </p>
    </form>
@endsection
