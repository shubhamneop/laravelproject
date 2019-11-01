@extends('master')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
       <h2>Page creater</h2>
   </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-12 margin-tb">

            <div class="pull-right">

                      <a href="{{ url('/admin/pages/') }}" class="btn btn-info btn-sm" title="Add New product">
                          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                      </a>
              </div>
           </div>
     </div>
      <div class="row">
        {!!Form::open(array('url'=>'admin/pages','method'=>'post','id'=>'page-form','enctype'=>'multipart/form-data'))!!}
           {{csrf_field()}}
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
              {!!Form::label('Name')!!}
              {!! Form::text('name',old("name"),['id'=>'name','class'=>'form-control','required'=>'required','placeholder'=>'Eg. Example page'])!!}
                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
              {!!Form::label('Title')!!}
              {!! Form::text('title',old("title"),['id'=>'title','class'=>'form-control','required'=>'required','placeholder'=>'Eg. Example page title'])!!}

                  {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
              {!!Form::label('Slug')!!}
              {!! Form::text('slug',old("slug"),['id'=>'slug','class'=>'form-control','required'=>'required','placeholder'=>'Eg. example-page '])!!}

                 {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">

              <div class="box box-info">
                <div class="box-header">
                  {!!Form::label('content') !!}
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                       {!!Form::textarea('content',null,['id'=>'content','row'=>'10','cols'=>80])!!}

                </div>
              </div>

            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
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
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            {!! Form::button('Publish',['type'=>'submit','class'=>'btn btn-success'])!!}
          </div>
        {!!Form::close()!!}
      </div>


    </section>
</div>
@endsection
@section('script')

<script src="../../bower_components/ckeditor/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
$(function () {

  CKEDITOR.replace('content').config.allowedContent = true;

});
</script>
@endsection
