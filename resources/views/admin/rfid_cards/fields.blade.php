<!-- User Id Field -->
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Membre:') !!}
        {{--    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
        {!! Form::select('user_id', $members, null, ['class' => 'form-control select2', 'placeholder' => 'Choisis un membre']) !!}
    </div>
</div>

<!-- Name Field -->
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Nom:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Uid Field -->
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('uid', 'Uid:') !!}
        {!! Form::text('uid', null, ['class' => 'form-control']) !!}
    </div>
</div>

<p>
    <i>Le token est généré automatiquement au fromat UUID</i>
</p>

<!-- Submit Field -->
<div class="row">
    <div class="form-group col-sm-12">
        {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('admin.rfidCards.index') !!}" class="btn btn-default">Annuler</a>
    </div>
</div>
