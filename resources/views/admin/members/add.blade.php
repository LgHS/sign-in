@extends('layouts.app')

@section('page_title')
    Ajouter un membre
@endsection

@section('content')
    <h3>Ajouter un membre</h3>

    @include('admin.forms.member', ['member' => null, 'action_label' => 'Ajouter un membre'])
    <p>
        En validant ce formulaire, un mail sera envoyé au membre avec un token
        d'initialisation du mot de passe.
    </p>
@endsection