@extends('layouts.app')

@section('page_title')
    Mon profil
@endsection

@section('content')
    <h3>Mon compte</h3>
    {!! BootForm::open(['model' => $member ?: null, 'update' => 'profile.update.advanced']) !!}
    <div class="row">
        <div class="col-sm-12">
            {!! BootForm::text('quote', 'Citation à la con', null) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {!! BootForm::text('skills_tags', 'Skills', null, array(
            'help_text' => 'séparés par des virgules (,)')) !!}
        </div>
        {{--<h3>Social</h3>--}}
        {{--<div class="col-sm-12">--}}
            {{--<label>Adresses mac</label>--}}
            {{--<table class="table">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<td>Social network</td>--}}
                    {{--<td>Tag</td>--}}
                    {{--<td></td>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($my_mac_addresses as $my_mac_address)--}}
                    {{--<tr>--}}
                        {{--<td>{!! $my_mac_address["mac_address"] !!}</td>--}}
                        {{--<td>{!! $my_mac_address["alias"] !!}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{route('profile.edit.remove.macaddress', $my_mac_address["mac_address"])}}"><span class="fa fa-trash-o"></span></a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--<tr>--}}
                    {{--<td>--}}
                        {{--<select id="mac_addresses" name="mac_address" class="form-control">--}}
                            {{--@foreach($mac_addresses as $mac_address)--}}
                                {{--<option value="{{ $mac_address["mac_address"] }}">{{ $mac_address["mac_address"] }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--{!! BootForm::text('mac_address_alias', false) !!}--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<a href=""><span class="fa fa-ok"></span></a>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}

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
    </div>

    <div class="row">
        {{--ed25519 rsa--}}
        <div class="col-sm-12">
            {!! BootForm::text('ssh_key', 'SSH Key', null, array(
            'help_text' => 'ed25519 ou rsa uniquement')) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label>Adresses mac</label>
            <table class="table">
                <thead>
                    <tr>
                        <td>Adresse</td>
                        <td>Alias</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($my_mac_addresses as $my_mac_address)
                    <tr>
                        <td>{!! $my_mac_address["mac_address"] !!}</td>
                        <td>{!! $my_mac_address["alias"] !!}</td>
                        <td>
                            <a href="{{route('profile.edit.remove.macaddress', $my_mac_address["mac_address"])}}"><span class="fa fa-trash-o"></span></a>
                        </td>
                    </tr>
                        @endforeach
                    <tr>
                        <td>
                            <select id="mac_addresses" name="mac_address" class="form-control">
                                @foreach($mac_addresses as $mac_address)
                                    <option value="{{ $mac_address["mac_address"] }}">{{ $mac_address["mac_address"] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! BootForm::text('mac_address_alias', false) !!}
                        </td>
                        <td>
                            <a href=""><span class="fa fa-ok"></span></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    {!! BootForm::submit('Modifier') !!}

    {!! BootForm::close() !!}
@endsection
