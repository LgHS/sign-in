@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Services OAuth</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div id="app">
            @permission(('manage-oauth-clients'))
            <h4>Gérer les clients</h4>
            <passport-clients></passport-clients>
            @endpermission
        </div>
    </div>
@endsection
