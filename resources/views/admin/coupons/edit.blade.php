@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Edit coupon #{{ $coupon->id }} </h3>
     </section>
     <section class="content">

                        <div class="pull-right">

                        <a href="{{ url('/admin/coupons') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                      </div><br><br>



          {!! Form::model($coupon, ['method' => 'PATCH','url' => ['/admin/coupons', $coupon->id],'data-parsley-validate','files' => true]) !!}

                          @include ('admin.coupons.form', ['formMode' => 'edit'])

          {!! Form::close() !!}


    </section>
      </div>
@endsection
