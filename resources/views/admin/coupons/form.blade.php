

<div class="col-xs-12 col-sm-12 col-md-12 form-group">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($coupon->title) ? $coupon->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 form-group">
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($coupon->code) ? $coupon->code : ''}}"    data-parsley-required-message="Enter  alphanumeric value" data-parsley-pattern="/^\(?([a-zA-Z]+)\)?[-. ]?([0-9]+)$/" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 form-group">
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <select class="form-control" name="type">
        <option value="">Select type</option>
    	<option value="Amount">Amount</option>
    	<option value="Percent">Percent</option>
    </select>
   
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 form-group">
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'Discount' }}</label>
    <input class="form-control" name="discount" type="number" id="discount" value="{{ isset($coupon->discount) ? $coupon->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 form-group">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" id="register">
</div>
</div>




