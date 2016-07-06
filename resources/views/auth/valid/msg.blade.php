@extends('layouts.app')

@section('content')
    <h2>
        <a href="{{ url('/') }}" title="Acceuil"> <img src="/dist/svg/logo.svg" alt="Liege Hackerspace"></a>
    </h2>

    <p>{{ $msg  }}</p>
@endsection
