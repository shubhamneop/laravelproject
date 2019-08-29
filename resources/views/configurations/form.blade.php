<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($configuration->name) ? $configuration->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="control-label">{{ 'Value' }}</label>
    <textarea class="form-control" rows="5" name="value" type="textarea" id="value" >{{ isset($configuration->value) ? $configuration->value : ''}}</textarea>
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name') ? 'has-error' : ''}}">
    <label for="--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name" class="control-label">{{ '--view-path=admin Dash --controller-namespace=admin Dash --route-group=admin Dash --form-helper=html
Php Artisan Crud:generate Configurations --fields=name' }}</label>
    <input class="form-control" name="--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name" type="text" id="--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name" value="{{ isset($configuration->--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name) ? $configuration->--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name : ''}}" >
    {!! $errors->first('--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
