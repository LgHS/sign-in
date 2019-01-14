@extends('layouts.app')

@section('page_title')
    Mes services
@endsection

@section('content')
    <h3>Statistiques</h3>
    <p>
        <i>
            Rentrées d'abonnements mensuels pour chaque mois (les cotisations annuelles ne sont pas prises en compte).
        </i>
    </p>
    <div id="app">
        @foreach($stats as $stat)
            <p>
                <strong>
                    {{ $stat->month->format('M Y') }}:
                </strong>
                {{ number_format($stat->amount, 2, ',', ',') }} €
            </p>
        @endforeach
    </div>
@endsection
