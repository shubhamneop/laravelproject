@extends('master')

@section('content')
 <div class="content-wrapper "style="min-height: 100%">
        <section class="content-header">
        <h2>Create New EmailTemplate</h2>
        </section>
     <section class="content">

                     <div class="row">
                       <div class="col-xs-12 margin-tb">
                          <div class="pull-right">
                            <a href="{{ url('/admin/email-templates') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                          </div>
                       </div>
                     </div>


                        <br />
                        <br />

                      

                        {!! Form::open(['url' => '/admin/email-templates','data-parsley-validate', 'files' => true]) !!}

                        @include ('admin.email-templates.form', ['formMode' => 'create'])

                        {!! Form::close() !!}




        </section>
    </div>
@endsection

@section('script')

<script src="../../bower_components/ckeditor/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
$(function () {

  CKEDITOR.replace('message').config.allowedContent = true;

});
</script>
@endsection
