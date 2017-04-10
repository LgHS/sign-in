<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Has Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('has_duration', 'Has Duration:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('has_duration', false) !!}
        {!! Form::checkbox('has_duration', 'yes', null) !!} yes
    </label>
</div>

<!-- Default Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('default_duration', 'Default Duration:') !!}
    {!! Form::number('default_duration', null, ['class' => 'form-control']) !!}
</div>

<!-- Default Amout Field -->
<div class="form-group col-sm-6">
    {!! Form::label('default_amout', 'Default Amout:') !!}
    {!! Form::text('default_amout', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.transactionTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
