<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
    {!! Form::label('description', 'Description: ', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::label('start_date', 'Start Date: ', ['class' => 'control-label']) !!}
    {!! Form::datetime('start_date', null, ['class' => 'form-control']) !!}
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::label('finish_date', 'Finish Date: ', ['class' => 'control-label']) !!}
    {!! Form::datetime('finish_date', null, ['class' => 'form-control']) !!}
    {!! $errors->first('finish_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::label('gold', 'Gold: ', ['class' => 'control-label']) !!}
    {!! Form::datetime('gold', null, ['class' => 'form-control']) !!}
    {!! $errors->first('gold', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::label('exp', 'Experience Point: ', ['class' => 'control-label']) !!}
    {!! Form::datetime('exp', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('exp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
