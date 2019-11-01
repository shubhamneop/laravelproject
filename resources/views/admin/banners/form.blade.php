

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change'] : ['class' => 'form-control','required'=>'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bannername') ? 'has-error' : ''}}">
    {!! Form::label('bannername', 'Bannername', ['class' => 'control-label']) !!}
    {!! Form::file('bannername', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('bannername', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode=='edit')

<div class="col-xs-12 col-sm-12 col-md-12 form-group">
  <img src="{{asset('/storage/' .$banner->bannername)}}"  style="width:50px;height:70px;" data-parsley-required>
</div>
@endif

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
