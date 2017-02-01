@extends('layouts.app')

@section('page_title')
    Mes services
@endsection

@section('content')
    <h3>Mes services</h3>

    <div id="app">
        @permission(('manage-oauth-clients'))
            <h4>Gérer les clients</h4>
            <passport-clients></passport-clients>
        @endpermission

        <h4>Services autorisés</h4>
        <passport-authorized-clients></passport-authorized-clients>
    </div>
@endsection