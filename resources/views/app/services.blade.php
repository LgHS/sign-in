@extends('layouts.app')

@section('page_title')
    Mes services
@endsection

@section('content')
    <h3>Services autorisés</h3>
    <div id="app">
        <passport-authorized-clients></passport-authorized-clients>
    </div>
@endsection