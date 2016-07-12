@extends('layouts.auth')

@section('page_title')
    Authorisation pour {{$client->getName()}}
@endsection

@section('title')
    L'application "{{$client->getName()}}" aimerai utiliser votre identification pour vous connecter sur sa platform.
@endsection

@section('content')
    <form id="sign-in-form" method="POST" action="{{route('oauth.authorize.post', $params)}}">
        {{ csrf_field() }}
        <input type="hidden" name="client_id" value="{{$params['client_id']}}">
        <input type="hidden" name="redirect_uri" value="{{$params['redirect_uri']}}">
        <input type="hidden" name="response_type" value="{{$params['response_type']}}">
        <input type="hidden" name="state" value="{{$params['state']}}">
        <input type="hidden" name="scope" value="{{$params['scope']}}">


        <p class="form-submit">
            <button type="submit" class="btn btn-success" name="approve" value="1">Accepter</button>
        </p>

        <p class="form-submit">
            <button type="submit" class="btn btn-danger" name="deny" value="1">Refuser</button>
        </p>
    </form>
@endsection
