@extends('layouts.auth')

@section('page_title')
    Mot de passe perdu
@endsection

@section('title')
    Mot de passe perdu :(
@endsection

@section('content')
    @include('auth.passwords._reset-password-form', ['submit' => ['icon' => 'refresh', 'label' => 'Réinitialiser le mot de passe']])
@endsection
