@extends('layouts.auth')

@section('page_title')
    Choisir un mot de passe
@endsection

@section('title')
    Choisissez votre mot de passe
@endsection

@section('content')
    @include('auth.passwords._reset-password-form', ['submit' => ['icon' => 'rocket', 'label' => 'C\'est parti !']])
@endsection
