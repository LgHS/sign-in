<div class="row">
    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Membre:') !!}
        {!! Form::select('user_id', $members, null, ['class' => 'form-control select2', 'placeholder' => 'Choisis un membre']) !!}
    </div>
</div>

<div class="row">
    <!-- Transaction Type Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('transaction_type_id', 'Type de Cotisation:') !!}
        {!! Form::select('transaction_type_id', $transaction_types, null, ['class' => 'form-control']) !!}
    </div>

    <!-- Amount Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('amount', 'Montant (€):') !!}
        {!! Form::text('amount', isset($transaction) ? null : 20, ['class' => 'form-control']) !!}
    </div>

    <!-- Payment Type Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('payment_type_id', 'Type de paiement:') !!}
        {!! Form::select('payment_type_id', $payment_types, null, ['class' => 'form-control']) !!}
    </div>

    <!-- Duration Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('duration', 'Durée (mois):') !!}
        {!! Form::number('duration', isset($transaction) ? null : 1, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <!-- Started At Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('started_at', 'Date de départ:') !!}
        {!! Form::date('started_at', isset($transaction) ? $transaction->started_at : Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    </div>

    <!-- Registered At Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('registered_at', 'Date de l\'enregistrement:') !!}
        {!! Form::date('registered_at', isset($transaction) ? $transaction->registered_at : Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <!-- Comments Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('comments', 'Commentaires:') !!}
        {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Enregistrer la transaction', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('admin.transactions.index') !!}" class="btn btn-default">Annuler</a>
    </div>
</div>