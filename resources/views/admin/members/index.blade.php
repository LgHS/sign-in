@extends('layouts.app')

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
                <th>Actions</th>
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
                    <td>
                        <a href="/members/{{$member->id}}/edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection