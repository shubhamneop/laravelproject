<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change'] : ['class' => 'form-control','required'=>'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    {!! Form::label('value', 'Value', ['class' => 'control-label']) !!}
    {!! Form::email('value', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-type'=>'email','data-parsley-trigger'=>'change'] : ['class' => 'form-control','required'=>'required','data-parsley-type'=>'email','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-success']) !!}
</div>
