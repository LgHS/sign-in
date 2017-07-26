@extends('layouts.app')

@section('page_title')
    Mon profil
@endsection

@section('content')
    <h3>Mon compte</h3>
    {!! BootForm::open(['model' => $member ?: null, 'update' => 'profile.update']) !!}
    <div class="row">
        <div class="col-sm-6">
            {!! BootForm::text('username', 'Nom d\'utilisateur', null) !!}
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            {!! BootForm::email('email', 'Adresse e-mail', null) !!}
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            {!! BootForm::password('old_password', 'Mot de passe actuel', array()) !!}
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            {!! BootForm::password('new_password', 'Nouveau mot de passe', array(
            'help_text' => trans('validation.secure'))) !!}
        </div>
    </div>



    <hr>

    <h3>Mon profil</h3>
    <div class="row">
        <div class="col-sm-6">
            {!! BootForm::text('firstName', 'Prénom') !!}
        </div>
        <div class="col-sm-6">
            {!! BootForm::text('lastName', 'Nom') !!}
        </div>
    </div>
    {!! BootForm::text('date_of_birth', 'Date de naissance', null, ['help_text' => 'dd/mm/YYYY']) !!}
    {!! BootForm::text('address', 'Adresse') !!}
    <div class="row">
        <div class="col-sm-4">
            {!! BootForm::text('postcode', 'Code postal') !!}
        </div>
        <div class="col-sm-8">
            {!! BootForm::text('city', 'Ville') !!}
        </div>
    </div>
    {!! BootForm::text('country', 'Pays', $member ? null : 'Belgium') !!}
    {!! BootForm::text('phone', 'Numéro de téléphone') !!}

    {!! BootForm::submit('Modifier mon profil') !!}

    {!! BootForm::close() !!}
@endsection
