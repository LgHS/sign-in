@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Payment Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($paymentType, ['route' => ['admin.paymentTypes.update', $paymentType->id], 'method' => 'patch']) !!}

                        @include('admin.payment_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection