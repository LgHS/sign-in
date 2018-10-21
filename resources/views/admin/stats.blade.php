@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Statistics</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

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
    </div>
@endsection
