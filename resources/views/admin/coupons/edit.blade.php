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
                      </div>



                        <form id="coupon-form" method="POST" action="{{ url('/admin/coupons/' . $coupon->id) }}"  accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                               <div class="row">
                            @include ('admin.coupons.form', ['formMode' => 'edit'])
                               </div>
                        </form>


        </section>
      </div>
@endsection
@section('script')
  <script type="text/javascript">
      $(document).ready(function() {
           $("#coupon-form").parsley();
               });
  </script>

  <script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>
@endsection
