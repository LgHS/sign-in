@extends('layouts.app')

@section('page_title')
    Edition du membre {{$member->username}}
@endsection

@section('content')
    <h3>Editer le membre <i>{{$member->username}}</i></h3>

    @include('admin.forms.member', ['member' => $member, 'action_label' => 'Modifier le membre'])
@endsection