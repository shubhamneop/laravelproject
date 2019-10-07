@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Orders</h2>
    </section>
     <section class="content">

       @if($message = Session::get('success'))

         <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert">×</button>
               <p>{{$message}}</p>
        </div>
      @endif
                     <div class="row" style="float:right;">
                     <div class="pull-right col-xs-12">
                        <form method="GET" action="{{ url('/admin/order') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                             <div class="">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="">
                                    <button class="btn btn-info" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Quantity</th><th>Total Price</th><th>Status</th><th>Placed At</th><th>Customer name</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($orders as $order)


                                    <tr>

                                        <td> {{ $order->order_no }} </td>
                                        <td>{{$order->cart->totalQty}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{ucfirst($order->status)}} </td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{ucfirst($order->address['fullname'])}}</td>

                                        <td>
                                           @can('order-list')
                                            <a href="{{ url('/admin/order/' . $order->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan
                                            <a href="{{  url('/admin/order/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                              <!-- <form method="POST" action="{{ url('/admin/order'  . '/' . $order->id) }}" accept-charset="UTF-8" style="display:inline">
                                                  {{ method_field('DELETE') }}
                                                   {{ csrf_field() }}
                                                     <button type="submit" class="btn btn-danger btn-sm" title="Delete coupon" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form> -->
                                            </td>
                                </tr>
                              @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $orders->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>




        </section>
    </div>
@endsection
@section('script')
<script>
$(document).ajaxStart(function() { Pace.restart(); });
</script>

@endsection
