@extends('layouts.app')

@section('page_title')
    Authorisation pour
@endsection

@section('content')
    <h3>Hello world {{ Route::currentRouteName() }}/h3>

    <p>
        Il n'y a encore rien à faire ici. En attendant, vous pouvez utiliser votre compte LgHS
        pour vous connecter à notre <a href="http://wiki.lghs.be">wiki</a> et au <a href="https://chat.lghs.be">chat</a>.
    </p>
    <p>
        Vous aurez bientôt la possibilité de gérer votre compte à partir de cette interface.
    </p>
@endsection
