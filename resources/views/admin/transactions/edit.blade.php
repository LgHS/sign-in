@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transaction
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::model($transaction, ['route' => ['admin.transactions.update', $transaction->id], 'method' => 'patch']) !!}

                @include('admin.transactions.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection