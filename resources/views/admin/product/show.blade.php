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
                                    
                                    <tr><th> Name </th><td> {{ $products->name }} </td></tr><tr><th> Description </th><td> {{ $products->description }} </td></tr><tr><th> Image  </th><td><img src="{{asset('product/' . $products->image->image_path )}}"  style="width:50px;height:70px;"> </td></tr>
                                    <tr><th>Price</th><td>{{$products->price}}</td></tr>
                                    <tr><th> Category </th><td> {{ $products->category->categories->category_name }} </td></tr><tr>
                                           
                                        <th> Colour </th><td> {{ $products->attribute->color }} </td></tr><tr><th>Quantity</th><td>{{$products->attribute->quantity}}</td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
