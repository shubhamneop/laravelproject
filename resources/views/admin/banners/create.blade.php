@extends('master')

@section('content')
 <div class="content-wrapper "style="min-height: 100%">
        <section class="content-header">
        <h2>Create New Banner</h2>
        </section>
     <section class="content">

                     <div class="row">
                       <div class="col-xs-12 margin-tb">
                          <div class="pull-right">
                            <a href="{{ url('/admin/banners') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden=""></i> Back</button></a>
                          </div>
                       </div>
                     </div>
                     {!! Form::open(['url' => '/admin/banners','data-parsley-validate', 'files' => true]) !!}

                     @include ('admin.banners.form', ['formMode' => 'create'])

                        {!! Form::close() !!}




        </section>
    </div>
@endsection
