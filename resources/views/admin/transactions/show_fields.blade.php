<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $transaction->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $transaction->user_id !!}</p>
</div>

<!-- Transaction Type Id Field -->
<div class="form-group">
    {!! Form::label('transaction_type_id', 'Transaction Type Id:') !!}
    <p>{!! $transaction->transaction_type_id !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{!! $transaction->amount !!}</p>
</div>

<!-- Payment Type Id Field -->
<div class="form-group">
    {!! Form::label('payment_type_id', 'Payment Type Id:') !!}
    <p>{!! $transaction->payment_type_id !!}</p>
</div>

<!-- Started At Field -->
<div class="form-group">
    {!! Form::label('started_at', 'Started At:') !!}
    <p>{!! $transaction->started_at !!}</p>
</div>

<!-- Registered At Field -->
<div class="form-group">
    {!! Form::label('registered_at', 'Registered At:') !!}
    <p>{!! $transaction->registered_at !!}</p>
</div>

<!-- Duration Field -->
<div class="form-group">
    {!! Form::label('duration', 'Duration:') !!}
    <p>{!! $transaction->duration !!}</p>
</div>

<!-- Comments Field -->
<div class="form-group">
    {!! Form::label('comments', 'Comments:') !!}
    <p>{!! $transaction->comments !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $transaction->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $transaction->updated_at !!}</p>
</div>

