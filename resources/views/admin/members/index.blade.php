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
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>
                                Nom
                            </th>
                            <th>
                                Statut
                            </th>
                            <th>
                                Etat cotisations
                            </th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    {{$member->fullName}}
                                </td>
                                <td>
                                    {{$member->statut}}
                                </td>
                                <td>
                                    @foreach($member->dueDates as $dueDate)
                                        <span class="label label-{{$dueDate['difference'] >= 0 ? 'success' : 'danger'}}">
                                            {{$dueDate['name']}}:
                                            @if($dueDate['difference'] > 0)
                                                {{$dueDate['difference']}} jours restants
                                            @elseif($dueDate['difference'] == 0)
                                                Dernier jour !
                                            @else
                                                En retard de {{abs($dueDate['difference'])}} jours
                                            @endif
                                        </span>
                                        &nbsp;
                                    @endforeach
                                </td>
                                <td>
                                    {{$member->fullName}}
                                </td>
                                <td>
                                    <form class="form-inline" style="display: inline;"
                                          action="/members/{{$member->id}}/sendResetMail" method="post">
                                        {{csrf_field()}}

                                        <button type="submit" class="btn btn-xs">
                                            <i class="fa fa-mail-forward"></i>
                                            Renvoyer le mail
                                        </button>
                                    </form>
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