@extends('master')

@section('content')
 <div class="content-wrapper "style="min-height: 100%">
        <section class="content-header">
        <h2>Create New configuration</h2>
        </section>
     <section class="content">

        <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-right">
              <a href="{{ url('/admin/configurations') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden=""></i> Back</button></a>
                 </div>
             </div>
          </div>
            {!! Form::open(['url' => '/admin/configurations', 'data-parsley-validate', 'files' => true]) !!}

                 @include ('admin.configurations.form', ['formMode' => 'create'])

             {!! Form::close() !!}
                      
     </section>
  </div>
@endsection
