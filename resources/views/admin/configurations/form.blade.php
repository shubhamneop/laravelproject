
 <div class="col-xs-12 col-sm-12 col-md-12">

  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($configuration->name) ? $configuration->name : ''}}" data-parsley-required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-trigger="keyup" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
   </div>
 </div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="control-label">{{ 'Value' }}</label>
    <input class="form-control" name="value" type="text" id="value" value="{{ isset($configuration->value) ? $configuration->value : ''}}"data-parsley-required data-parsley-type="email" data-parsley-trigger="keyup" >
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
 <div class="form-group">
    <input class="btn btn-success" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
 </div>
</div>
