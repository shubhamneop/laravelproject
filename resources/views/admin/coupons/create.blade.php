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

                    

                        <form  id="demo-form"method="POST" action="{{ url('/admin/coupons') }}"  accept-charset="UTF-8" enctype="multipart/form-data" data-parsley-validate>
                            {{ csrf_field() }}

                            @include ('admin.coupons.form', ['formMode' => 'create'])

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
