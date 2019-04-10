<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $rfidCard->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $rfidCard->name !!}</p>
</div>

<!-- Token Field -->
<div class="form-group">
    {!! Form::label('token', 'Token:') !!}
    <p>{!! $rfidCard->token !!}</p>
</div>

<!-- Uid Field -->
<div class="form-group">
    {!! Form::label('uid', 'Uid:') !!}
    <p>{!! $rfidCard->uid !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User:') !!}
    <p>{!! $rfidCard->user->username !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $rfidCard->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $rfidCard->updated_at !!}</p>
</div>

