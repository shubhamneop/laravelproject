<div class="form-group {{ $errors->has('fullname') ? 'has-error' : ''}}">
    {!! Form::label('fullname', 'Fullname', ['class' => 'control-label']) !!}
    {!! Form::text('fullname', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change'] : ['class' => 'form-control','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('fullname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
    {!! Form::label('address1', 'Address1', ['class' => 'control-label']) !!}
    {!! Form::text('address1', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('address1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address2') ? 'has-error' : ''}}">
    {!! Form::label('address2', 'Address2', ['class' => 'control-label']) !!}
    {!! Form::text('address2', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('address2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
    {!! Form::label('zipcode', 'Zipcode', ['class' => 'control-label']) !!}
    {!! Form::text('zipcode', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-parsley-type'=>'number' ,'data-parsley-pattern'=>'/^\d{6}$/' ,'data-parsley-trigger'=>'change'] : ['class' => 'form-control','required'=>'required','data-parsley-type'=>'number' ,'data-parsley-pattern'=>'/^\d{6}$/' ,'data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
    {!! Form::text('country', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    {!! Form::label('state', 'State', ['class' => 'control-label']) !!}
    {!! Form::text('state', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phoneno') ? 'has-error' : ''}}">
    {!! Form::label('phoneno', 'Phoneno', ['class' => 'control-label']) !!}
    {!! Form::text('phoneno', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phoneno', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('mobileno') ? 'has-error' : ''}}">
    {!! Form::label('mobileno', 'Mobileno', ['class' => 'control-label']) !!}
    {!! Form::text('mobileno', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-type'=>'number' ,'data-parsley-pattern'=>'/^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/' ,'data-parsley-trigger'=>'change'] : ['class' => 'form-control', 'required' => 'required','data-parsley-type'=>'number' ,'data-parsley-pattern'=>'/^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/' ,'data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('mobileno', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
