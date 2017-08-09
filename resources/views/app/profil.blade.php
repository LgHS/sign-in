@extends('layouts.app')

@section('page_title')
    Mon profil
@endsection

@section('content')
    <h3>Mon Profil</h3>
    <div class="row">
        <div class="col-md-3">
            <div class="panel text-center">
                <div class="panel-body">
                    <img src="http://lorempixel.com/150/150/cats" alt="">
                    <p>
                        {{$member->username}}
                    </p>
                </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item disabled">Modifier</li>
                <li class="list-group-item"><a href="{{route('profile.update')}}">Informations générales</a></li>
                <li class="list-group-item"><a href="{{route('profile.update.advanced')}}">Informations complémentaires</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-sm-12">
                        <blockquote>
                            {{$member->quote}}
                        </blockquote>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Skills</div>
                        <div class="panel-body">
                            @foreach(explode(',',$member->skills_tags) as $skill)
                            <span class="badge">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Social</div>
                        <div class="panel-body">
                            @if(isset(json_decode($member->social)->facebook))
                                <p>
                                    <span class="fa fa-fw fa-facebook"></span>{!! json_decode($member->social)->facebook !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->twitter))
                                <p>
                                    <span class="fa fa-fw fa-twitter"></span>{!! json_decode($member->social)->twitter !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->instagram))
                                <p>
                                    <span class="fa fa-fw fa-instagram"></span>{!! json_decode($member->social)->instagram !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->github))
                                <p>
                                    <span class="fa fa-fw fa-github"></span>{!! json_decode($member->social)->github !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->bitbucket))
                                <p>
                                    <span class="fa fa-fw fa-bitbucket"></span>{!! json_decode($member->social)->bitbucket !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->dribbble))
                                <p>
                                    <span class="fa fa-fw fa-dribbble"></span>{!! json_decode($member->social)->dribbble !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->mastodon))
                                <p>
                                    <span class="fa fa-fw fa-hand-spock-o"></span>{!! json_decode($member->social)->mastodon !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->behance))
                                <p>
                                    <span class="fa fa-fw fa-behance"></span>{!! json_decode($member->social)->behance !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->codepen))
                                <p>
                                    <span class="fa fa-fw fa-codepen"></span>{!! json_decode($member->social)->codepen !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->jsfiddle))
                                <p>
                                    <span class="fa fa-fw fa-jsfiddle"></span>{!! json_decode($member->social)->jsfiddle !!}
                                </p>
                                @endif
                            @if(isset(json_decode($member->social)->diaspora))
                                <p>
                                    <span class="fa fa-fw fa-hand-spock-o"></span>{!! json_decode($member->social)->diaspora !!}
                                </p>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Mac addresses</div>
                        <div class="panel-body">
                            <ul>
                                @foreach($mac_addresses as $mac_address)
                                    <li>{{$mac_address["mac_address"] }}: {{ $mac_address["alias"] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Logs</div>
                        <div class="panel-body">Logs des merdes que tu fais au HS (édits wiki, arrive/quitte le HS, troll Iooner, pushs/pushs request sur le git,...) </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
