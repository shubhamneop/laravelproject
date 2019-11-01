@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Add Coupons </h3>
     </section>
     <section class="content">
           <div class="pull-right">
             <a href="{{ url('/admin/coupons') }}" title="Back"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
           </div><br><br>
         {!! Form::open(['url' => '/admin/coupons', 'data-parsley-validate', 'files' => true]) !!}

             @include ('admin.coupons.form', ['formMode' => 'create'])

         {!! Form::close() !!}

      </section>
    </div>
@endsection
