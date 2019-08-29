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

                

                        <form id="demo-form" method="POST" action="{{ url('/admin/coupons/' . $coupon->id) }}"  accept-charset="UTF-8" enctype="multipart/form-data" data-parsley-validate>
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                               <div class="row"> 
                            @include ('admin.coupons.form', ['formMode' => 'edit'])
                               </div>
                        </form>


<script type="text/javascript">
$(function () {
    $('#demo-form').parsley();
});
</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
