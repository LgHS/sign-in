@extends('admin.layouts.app')

@section('page_title')
    Ajouter un membre
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Ajouter un membre
        </h1>
    </section>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                @include('admin.members.form', ['member' => null, 'action_label' => 'Ajouter un membre'])
                <p>
                    En validant ce formulaire, un mail sera envoyé au membre avec un token
                    d'initialisation du mot de passe.
                </p>
            </div>
        </div>
    </div>
@endsection