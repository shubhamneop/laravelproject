@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Order Details</h2>
    </section>
     <section class="content">


                 <div class="pull-right">
                   <h2><a href="{{ url('/admin/order') }}" class="btn btn-primary" > <i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></h3>
                 </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th>#</th><th>Product</th><th>Quantity</th><th>Price</th>
                                    </tr>
                                </thead>
                                    @foreach($orders->items as $item)
                                    <tr>
                                        <td>
                                          <img src="{{asset('product/' .$item['image'])}}" alt="" width="60px" height="60px" /></td>
                                        <td> {{strtoupper($item['item']['name'])}}</td>
                                        <td> {{$item['qty']}}</td>
                                        <td>{{$item['price']}}</td>
                                    </tr>
                                @endforeach
                                 <tr>



                                     <tr><td>Status</td>  <td>{{$order->status}} </td></tr>
                                     <tr><td>Total Amount</td>  <td >{{$order->total}}</td></tr>
                                     <tr><td>Customer</td>  <td><a href="{{url('users/'.$order->user->id)}}" >{{$order->user->name}}</a></td></tr>
                                     <tr><td>Customer Address </td><td>{{$order->address->fullname}} {{$order->address->address1}} {{$order->address->address2}} {{$order->address->zipcode}} {{$order->address->cuntry}} {{$order->address->state}} {{$order->address->phoneno}} {{$order->address->mobileno}}</td>
                                      <tr><td>Payment Mode</td>  <td>{{$order->payment_mode}}</td></tr>
                                        <tr><td>Payment Id</td>  <td>{{$order->payment_id}}</td></tr>


                               </tr>


                            </table>

                        </div>

                        <div class="modal modal-default fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Customer Details</h4>
                              </div>
                              <div class="modal-body">
                                <p>{{$order->address->fullname}} {{$order->address->address1}} {{$order->address->address2}}
                                  {{$order->address->zipcode}} {{$order->address->country}} {{$order->address->state}}
                                  {{$order->address->phoneno}} {{$order->address->mobileno}}

                                </p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-outline">Save changes</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>


        </section>
    </div>
@endsection
