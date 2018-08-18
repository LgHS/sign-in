<table class="table table-responsive" id="transactions-table">
    <thead>
    <tr>
        <th>Membre</th>
        <th>Type</th>
        <th>Montant</th>
        <th>Date de début</th>
        <th>Date d'enregistrement</th>
        <th>Type de paiement</th>
        <th>Durée</th>
        <th>Commentaires</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        @if ($transaction->user)
            <tr>
                <td>{!! $transaction->user->fullName !!}</td>
                <td>{!! $transaction->transactionType->name !!}</td>
                <td>{!! $transaction->amount !!}€</td>
                <td>{!! $transaction->started_at->format('d/m/Y') !!}</td>
                <td>{!! $transaction->registered_at->format('d/m/Y') !!}</td>
                <td>{!! $transaction->paymentType->name !!}</td>
                <td>{!! $transaction->duration !!} mois</td>
                <td>{!! $transaction->comments !!}</td>
                <td>
                    {!! Form::open(['route' => ['admin.transactions.destroy', $transaction->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.transactions.show', [$transaction->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin.transactions.edit', [$transaction->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
