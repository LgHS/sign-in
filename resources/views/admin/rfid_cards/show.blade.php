@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Rfid Card
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.rfid_cards.show_fields')
                    <a href="{!! route('admin.rfidCards.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
