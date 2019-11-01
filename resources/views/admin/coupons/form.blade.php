<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-required-message'=>'Please enter title','data-parsley-trigger'=>'change'] : ['class' => 'form-control', 'required' => 'required','data-parsley-required-message'=>'Please enter title','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-required-message'=>'Please enter Code','data-parsley-message'=>'Enter  alphanumeric value', 'data-parsley-pattern'=>'/^\(?([a-zA-Z]+)\)?[-. ]?([0-9]+)$/','data-parsley-trigger'=>'change'] : ['class' => 'form-control', 'required' => 'required','data-parsley-required-message'=>'Please enter code','data-parsley-message'=>'Enter  alphanumeric value', 'data-parsley-pattern'=>'/^\(?([a-zA-Z]+)\)?[-. ]?([0-9]+)$/','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', json_decode('{"":"Select Type","Amount": "Amount", "Percent": "Percent"}', true), null, ('' == 'required') ? ['class' => 'form-control','data-parsley-required-message'=>'Please select type', 'required' => 'required'] : ['class' => 'form-control','data-parsley-required-message'=>'Please select type', 'required' => 'required']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    {!! Form::label('discount', 'Discount', ['class' => 'control-label']) !!}
    {!! Form::text('discount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-required-message'=>'Please enter discount value','data-parsley-type'=>'number','data-parsley-trigger'=>'change'] : ['class' => 'form-control', 'required' => 'required','data-parsley-required-message'=>'Please enter discount value','data-parsley-type'=>'number','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    <div class="checkbox">
    <label>{!! Form::radio('status', '1', true) !!} Active</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('status', '0') !!} Inactive</label>
</div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
