<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $transactionType->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $transactionType->name !!}</p>
</div>

<!-- Has Duration Field -->
<div class="form-group">
    {!! Form::label('has_duration', 'Has Duration:') !!}
    <p>{!! $transactionType->has_duration !!}</p>
</div>

<!-- Default Duration Field -->
<div class="form-group">
    {!! Form::label('default_duration', 'Default Duration:') !!}
    <p>{!! $transactionType->default_duration !!}</p>
</div>

<!-- Default Amout Field -->
<div class="form-group">
    {!! Form::label('default_amout', 'Default Amout:') !!}
    <p>{!! $transactionType->default_amout !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $transactionType->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $transactionType->updated_at !!}</p>
</div>

