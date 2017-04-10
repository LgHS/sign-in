@extends('admin.layouts.app')

@section('page_title')
    Edition du membre {{$member->username}}
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editer le membre <i>{{$member->username}}</i>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                @include('admin.members.form', ['member' => $member, 'action_label' => 'Modifier le membre'])
            </div>
        </div>
    </div>
@endsection