@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Add Coupons </h3>
     </section>
     <section class="content">
           <div class="pull-right">
                  <a href="{{ url('/admin/coupons') }}" title="Back"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                   </div>



                        <form  id="coupon-form"method="POST" action="{{ url('/admin/coupons') }}"  accept-charset="UTF-8" enctype="multipart/form-data" >
                            {{ csrf_field() }}

                            @include ('admin.coupons.form', ['formMode' => 'create'])

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
