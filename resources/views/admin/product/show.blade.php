@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Product</h2>
    </section>
     <section class="content">
        <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-right">

                        <a href="{{ url('/admin/product') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                </div>
             </div>
         </div>



                        <div class="table-responsive">
                            <table class="table">


                                <tbody>

                                    <tr><th> Name </th><td> {{ ucfirst($product->name) }} </td></tr><tr><th> Description </th><td> {{ ucfirst($product->description) }} </td></tr><tr><th> Image  </th>
                                          @foreach($product->image as $image)
                                          @endforeach
                                      <td><img src="{{asset('product/' . $image->image_path )}}"  style="width:50px;height:70px;"> </td></tr>
                                    <tr><th>Price</th><td>{{$product->price}}</td></tr>
                                    <tr><th> Category </th><td> {{ ucfirst($product->category->categories->category_name) }} </td></tr><tr>

                                        <th> Colour </th><td> {{ ucfirst($product->attribute->color) }} </td></tr><tr><th>Quantity</th><td>{{$product->attribute->quantity}}</td></tr>
                                </tbody>
                            </table>
                        </div>


        </section>
    </div>
@endsection
