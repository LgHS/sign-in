@extends('layouts.app')

@section('content')
    <h2>Bienvenue sur ton compte LgHS !</h2>
    <p>
        Tu peux maintenant utiliser tes accès à ce compte pour te connecter aux différents services.
    </p>

    <h3>Services</h3>

    <div class="service-list">
        <div class="row">
            <div class="col-sm-6">
                <div class="service-list--item">
                    <h4>Rocket.Chat</h4>
                    <p>
                        Le chat du LgHS réservé aux membres.
                    </p>
                    <p class="cta">
                        <a target="_blank" href="https://chat.lghs.be" class="btn btn-primary">Ouvrir le chat</a>
                    </p>
                    <p>
                        <a href="https://rocket.chat/download" target="_blank">
                            Télécharger l'application pour Windows, Linux, OSX, Android ou iOS.
                        </a>
                    </p>
                </div>
            </div>

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
        </div>
    </div>

    <hr>

    <h3>Ton compte LgHS</h3>
    <p>
        Pour l'instant, il n'y a pas grand chose à faire ici. Quelques idées de développement incluent
        la possibilité de gérer tes cotis, voir les autres membres et des infos de contact, gérer une des accès RFID,...
    </p>
    <p>
        Plus d'infos sur le wiki: <a href="http://wiki.lghs.be/membres">http://wiki.lghs.be/membres</a>.
    </p>
@endsection
