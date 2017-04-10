@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ajouter un type de paiement
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.paymentTypes.store']) !!}

                        @include('admin.payment_types.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
