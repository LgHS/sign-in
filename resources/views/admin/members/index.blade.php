@extends('admin.layouts.app')

@section('page_title')
    Liste des membres
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Liste des membres</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('members.add') !!}">Ajouter</a>
        </h1>
    </section>
    <div class="content members-index">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nom
                        </th>
                        <th>
                            Statut
                        </th>
                        <th>
                            Abonnement mensuel
                        </th>
                        <th>
                            Cotisation annuelle
                        </th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr @if($member->roles()->first()->name == 'member_old')class="old"@endif>
                            <td>
                                {{$member->id}}
                            </td>
                            <td>
                                {{$member->fullName}}
                            </td>
                            <td>
                                {{$member->roles()->first()->display_name}}
                            </td>
                            @foreach($transactionTypes as $transactionType)
                                @php ($daysRemaining = $member->getRemainingDays($transactionType))
                                <td>
                                    @if($member->roles()->first()->name == 'member_old' or
                                            $member->roles()->first()->name == 'member_honorary')
                                        —
                                    @else
                                        @if($daysRemaining)
                                            <span class="label label-{{$daysRemaining >= 0 ? 'success' : 'danger' }}">
                                                {{$transactionType->name}}
                                                @if($daysRemaining > 0)
                                                    {{$daysRemaining}} jours restants
                                                @else
                                                    En retard de {{abs($daysRemaining)}} jours
                                                @endif
                                            </span>
                                        @elseif($daysRemaining === 0)
                                            <span class="label label-default">Dernier jour</span>
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                @if($member->roles()->first()->name !== 'member_old')
                                    <form class="form-inline" style="display: inline;"
                                          action="/members/{{$member->id}}/sendResetMail" method="post">
                                        {{csrf_field()}}

                                        <button type="submit" class="btn btn-xs">
                                            <i class="fa fa-mail-forward"></i>
                                            Mail reset
                                        </button>
                                    </form>

                                    @foreach($transactionTypes as $transactionType)
                                        @if($member->isLate($transactionType))
                                            <form class="form-inline" style="display: inline;"
                                                  action="/members/{{$member->id}}/sendReminder/{{$transactionType->id}}"
                                                  method="post">
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-xs" confirm>
                                                    <i class="fa fa-mail-forward"></i>
                                                    {{$transactionType->name}}
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td class="">
                                <form class="form-inline" method="post" action="/members/{{$member->id}}">
                                    <div class="btn-group">
                                        <a href="/members/{{$member->id}}/edit" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-xs btn-danger" confirm>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
