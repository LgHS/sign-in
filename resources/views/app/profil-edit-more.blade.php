@extends('layouts.app')

@section('page_title')
    Mon profil
@endsection

@section('content')
    <h3>Mon compte</h3>
    {!! BootForm::open(['model' => $member ?: null, 'update' => 'profile.update.more']) !!}
    <div class="row">
        <div class="col-sm-12">
            {!! BootForm::text('quote', 'Citation à la con', null) !!}
        </div>
        <div class="col-sm-12">
            {!! BootForm::text('skills_tags', 'Skills', null, array(
            'help_text' => 'séparés par des virgules (,)')) !!}
        </div>
        <div class="col-sm-2">
            {!! BootForm::text('social_facebook', 'Facebook', json_decode($member->social)->facebook) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_twitter', 'Twitter', json_decode($member->social)->twitter) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_instagram', 'Instagram', json_decode($member->social)->instagram) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_github', 'Github', json_decode($member->social)->github) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_bitbucket', 'Bitbucket', json_decode($member->social)->bitbucket) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_dribbble', 'Dribbble', json_decode($member->social)->dribbble) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_mastodon', 'Mastodon', json_decode($member->social)->mastodon) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_behance', 'Behance', json_decode($member->social)->behance) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_codepen', 'Codepen', json_decode($member->social)->codepen) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_jsfiddle', 'JSFiddle', json_decode($member->social)->jsfiddle) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_diaspora', 'Diaspora', json_decode($member->social)->diaspora) !!}
            </div>
            <div class="col-sm-2">
                {!! BootForm::text('social_tumblr', 'Tumblr', json_decode($member->social)->tumblr) !!}
        </div>
        <div class="col-sm-12">
            {!! BootForm::select('mac_addresses', "Adresses MAC", $mac_addresses) !!}
        </div>
    </div>

    {!! BootForm::submit('Modifier') !!}

    {!! BootForm::close() !!}
@endsection
