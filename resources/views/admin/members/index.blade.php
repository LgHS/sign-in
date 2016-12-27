@extends('layouts.app')

@section('page_title')
    Liste des membres
@endsection

@section('content')
    <h3>Liste des membres</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Nom d'utilisateur
                </th>
                <th>
                    Adresse e-mail
                </th>
                <th>
                    Nom
                </th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>
                        {{$member->id}}
                    </td>
                    <td>
                        {{$member->username}}
                    </td>
                    <td>
                        {{$member->email}}
                    </td>
                    <td>
                        {{$member->firstName}} {{$member->lastName}}
                    </td>
                    <td class="actions">
                        <a href="/members/{{$member->id}}/edit" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="/members/{{$member->id}}/sendResetMail" method="post">
                            {{csrf_field()}}

                            <button type="submit" class="btn btn-sm">
                                <i class="fa fa-mail-forward"></i>
                            </button>
                        </form>

                        <form action="/members/{{$member->id}}" class="display: inline;">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection