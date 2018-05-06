@extends('admin.layouts.app')

@section('page_title')
    Modification du code PIN du membre {{$member->username}}
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Forcer le code PIN du membre <i>{{$member->username}}</i>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                {!! BootForm::open(['model' => $member, 'update' => 'members.pin.update']) !!}
                {!! BootForm::password('pin', 'Code PIN', array(
                    'help_text' => 'Choisissez 4 chiffres'
                )) !!}
                {!! BootForm::submit('Modifier le code PIN') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection
