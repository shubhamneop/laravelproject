@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Edit product #{{ $product->id }} </h3>
     </section>
     <section class="content">

                        <div class="pull-right">

                        <a href="{{ url('/admin/product') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                      </div>



                        <form id="product-form" method="POST" action="{{ url('/admin/product/' . $product->id) }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.product.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
