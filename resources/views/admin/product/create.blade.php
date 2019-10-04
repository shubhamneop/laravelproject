@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Add Prodcts </h3>
     </section>
     <section class="content">
           <div class="pull-right" id="productData">
             <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                   </div>



                        <form id="product-form" method="POST" action="{{ url('/admin/product') }}" accept-charset="UTF-8"  enctype="multipart/form-data" data-parsley-validate>
                            {{ csrf_field() }}

                            @include ('admin.product.form', ['formMode' => 'create'])

                        </form>

        </section>
    </div>
@endsection
