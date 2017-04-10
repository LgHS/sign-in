<table class="table table-responsive" id="transactionTypes-table">
    <thead>
        <th>Name</th>
        <th>Has Duration</th>
        <th>Default Duration</th>
        <th>Default Amout</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($transactionTypes as $transactionType)
        <tr>
            <td>{!! $transactionType->name !!}</td>
            <td>{!! $transactionType->has_duration !!}</td>
            <td>{!! $transactionType->default_duration !!}</td>
            <td>{!! $transactionType->default_amout !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.transactionTypes.destroy', $transactionType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.transactionTypes.show', [$transactionType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.transactionTypes.edit', [$transactionType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>