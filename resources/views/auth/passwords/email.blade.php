@extends('layouts.auth')

@section('page_title')
    Mot de passe perdu
@endsection

@section('title')
    Mot de passe perdu ? C'est par ici.
    @endsection

<!-- Main Content -->
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="hide">Adresse e-mail</label>

            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                   placeholder="Adresse e-mail">

            @if ($errors->has('email'))
                <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-envelope"></i> Envoyer un lien de reset
            </button>
        </div>

        <p class="bottom-cta">
            <a href="{{ url('/login') }}" title="Connectez-vous">
                Pas de soucis de mot de passe ? Connectez-vous.
            </a>
        </p>
    </form>
@endsection
