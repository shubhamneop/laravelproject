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
        <form id='page-form' method="POST" action="{{url('/admin/pages/' . $page->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
           {{method_field('PATCH')}}
          {{csrf_field()}}
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
              <label for="title" class="control-label">{{ 'Name' }}</label>
              <input type="text" class="form-control" name="name"  id="name" value="{{$page->name}}" required>
                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
              <label for="title" class="control-label">{{ 'title' }}</label>
              <input type="text" class="form-control" name="title" id="title" value="{{$page->title}}" required>
                  {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
              <label for="title" class="control-label">{{ 'slug' }}</label>
              <input type="text" class="form-control" name="slug" id="slug" value="{{$page->slug}}" required>
                 {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">

              <div class="box box-info">
                <div class="box-header">
                   <label for="title" class="control-label">{{ 'content' }}</label>
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

                        <textarea id="content" name="content" rows="10" cols="80" >
                                   {{$page->content}}
                        </textarea>

                </div>
              </div>

            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
            <div class="form-group {{ $errors->has('extras') ? 'has-error' : ''}}">
              <label for="title" class="control-label">{{ 'status' }}</label>
                 <div class="radio">
                  <label class="label label-success"> <input type="radio" name="status"  value="{{ $page->status}}"> Active</label>
                </div>
                <div class="radio">
                 <label class="label label-danger"><input type="radio" name="status" value="{{ $page->status}}" checked>Inactive</label>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 form-group">
             <input type="submit" id="submit" value="Submit" class="btn btn-success">
          </div>
        </form>
      </div>


    </section>
</div>
@endsection
@section('script')

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->

<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
$(function () {

  CKEDITOR.replace('content');

});
</script>
@endsection
