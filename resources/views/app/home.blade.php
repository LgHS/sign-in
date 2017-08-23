@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Bienvenue sur ton compte LgHS !</h2>
            <p>
                Tu peux maintenant utiliser tes accès à ce compte pour te connecter aux différents services.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <h3>Services</h3>
            <div class="service-list">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="service-list--item">
                            <h4>Rocket.Chat</h4>
                            <p>
                                Le chat du LgHS réservé aux membres.
                            </p>
                            <p>
                                <a href="https://rocket.chat/download" target="_blank">
                                    Télécharger l'application pour Windows, Linux, OSX, Android ou iOS.
                                </a>
                            </p>
                            <p class="cta">
                                <a target="_blank" href="https://chat.lghs.be" class="btn btn-primary">Ouvrir le chat</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="service-list--item">
                            <h4>Loomio</h4>
                            <p>
                                Logiciel de prise de décision collaborative.
                            </p>
                            <p>
                                Les décisions au sein du Hackerspace se feront via Loomio.
                            </p>
                            <p class="cta">
                                <a target="_blank" href="https://loomio.lghs.be" class="btn btn-primary">Ouvrir Loomio</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="service-list--item">
                            <h4>Wiki</h4>
                            <p>
                                Le Wiki permet à chaque membre de documenter les projets, voir ou écrire des tutoriels sur
                                n'importe quel sujet.
                            </p>
                            <p class="cta">
                                <a target="_blank" href="http://wiki.lghs.be" class="btn btn-primary">Ouvrir le Wiki</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="service-list--item">
                            <h4>PasteBin</h4>
                            <p>
                                Un 'pastebin' (ou gestionnaire d'extraits de texte et de code source)
                                minimaliste et open source, dans lequel le serveur n'a aucune connaissance des données envoyées.
                            </p>
                            <p class="cta">
                                <a target="_blank" href="http://paste.lghs.be" class="btn btn-primary">Ouvrir le PasteBin</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <h3>Ton compte LgHS</h3>
            <p>
                Pour l'instant, il n'y a pas grand chose à faire ici. Quelques idées de développement incluent
                la possibilité de gérer tes cotis, voir les autres membres et des infos de contact, gérer une des accès RFID,...
            </p>
            <p>
                Plus d'infos sur le wiki: <a href="http://wiki.lghs.be/membres">http://wiki.lghs.be/membres</a>.
            </p>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">Qui qu'est la ?</div>
                <div class="panel-body">
                    {{$countMembers}} membres présents, dont:
                    @foreach($members as $member)
                        @if(empty($member->username))
                            {{$member->firstname}}
                        @else
                            {{$member->username}}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection