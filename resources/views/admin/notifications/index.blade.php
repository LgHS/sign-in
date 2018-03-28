@extends('admin.layouts.app')

@section('page_title')
    Liste des membres
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Log des notifications</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @foreach($notifications as $notification)
                    @if($notification->notifiable)
                        <p>
                            <strong>
                                {{$notification->created_at->format('d/m/Y')}}
                                {{$notification->created_at->format('H:i')}}
                            </strong>

                            {{$notification->notifiable ? $notification->notifiable->fullName : ""}}

                            @if($notification->type == \App\Notifications\InitPasswordNotification::class)
                                a reçu le mail d'init du mot de passe
                            @elseif($notification->type == \App\Notifications\ResetPasswordNotification::class)
                                a fait une demande de reset du mot de passe
                            @elseif($notification->type == \App\Notifications\ReminderNotification::class)
                                a reçu un rappel pour la transaction
                                <i>{{isset($notification->data['transaction_type']) ? $notification->data['transaction_type'] : ''}}</i>
                            @endif
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
