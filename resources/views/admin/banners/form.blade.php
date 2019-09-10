<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($banner->name) ? $banner->name : ''}}" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-trigger="keyup" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('bannername') ? 'has-error' : ''}}">
    <label for="bannername" class="control-label">{{ 'Bannername' }}</label>
    <input class="form-control" name="bannername" type="file" id="bannername" value="{{ isset($banner->bannername) ? $banner->bannername : ''}}" >
    {!! $errors->first('bannername', '<p class="help-block">:message</p>') !!}
</div>
</div>
@if($formMode=='edit')

<div class="col-xs-12 col-sm-12 col-md-12 form-group">
  <img src="{{asset('/storage/' .$banner->bannername)}}"  style="width:50px;height:70px;" data-parsley-required> 
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-success" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
