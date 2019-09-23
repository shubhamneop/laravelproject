@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Product</h2>
    </section>
     <section class="content">
        <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-left">

                        <a href="{{ url('/admin/product/create') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                </div>
             </div>
     </div>
     @if($message = Session::get('success'))

         <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert">×</button>
               <p>{{$message}}</p>
        </div>
     @endif

                <div class="row" style="float:right;">
                     <div class="pull-right col-xs-12">
                        <form method="GET" action="{{ url('admin/product') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="">
                                    <button class="btn btn-info" type="submit" style="margin-left:-24;" >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                 </div>
              <!---
                        <form method="GET" action="{{ url('/admin/product') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                     -->



         <div class="row">

                        <table class="table table-bordered">


                      <tr>
                      <th>#</th><th>Product</th><th>Description</th><th>Image</th><th>Category</th><th>Price</th><th>Colour</th><th>Quantity</th><th>Action</th>
                      </tr>



                         @foreach($products  as $product)
                            <tr> <td>{{ $loop->iteration }}</td>
                             <td>{{ ucfirst($product->name) }} </td>
                             <td>{{ucfirst($product->description)}}</td>

                               @foreach($product->image as $image)

                               @endforeach
                             <td><img src="{{asset('product/' . $image->image_path )}}"  style="width:50px;height:70px;"></td>
                             <td>{{ucfirst($product->category->categories->category_name)}}</td>
                             <td>{{$product->price}}</td>
                             <td>{{ucfirst($product->attribute->color)}}</td>
                             <td>{{$product->attribute->quantity}}</td>







                              <td>

                                <a href="{{ url('/admin/product/' . $product->id) }}" title="View configuration"><button class="btn btn-info "><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>

                                            @can('product-edit')
                                            <a href="{{ url('/admin/product/' . $product->id . '/edit') }}" title="Edit configuration"><button class="btn btn-success "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan


                                            <form method="POST" action="{{ url('/admin/product' . '/' . $product->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                 @can('product-delete')
                                                <button type="submit" class="btn btn-danger " title="Delete configuration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                @endcan
                                            </form>








                             </td></tr>

                         @endforeach


                     </table>
                     {!! $products->render() !!}
                    </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
