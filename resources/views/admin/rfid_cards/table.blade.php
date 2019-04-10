<table class="table table-responsive" id="rfidCards-table">
    <thead>
        <th>Membre</th>
        <th>Nom de la carte</th>
        <th>Token</th>
        <th>Uid</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($rfidCards as $rfidCard)
        <tr>
            <td>{!! $rfidCard->user->username !!}</td>
            <td>{!! $rfidCard->name !!}</td>
            <td>{!! $rfidCard->token !!}</td>
            <td>{!! $rfidCard->uid !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.rfidCards.destroy', $rfidCard->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.rfidCards.show', [$rfidCard->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.rfidCards.edit', [$rfidCard->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
