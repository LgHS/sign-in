@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Rfid Card
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               {!! Form::model($rfidCard, ['route' => ['admin.rfidCards.update', $rfidCard->id], 'method' => 'patch']) !!}

                    @include('admin.rfid_cards.fields')

               {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection
