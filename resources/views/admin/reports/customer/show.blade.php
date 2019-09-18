@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Order Details</h2>
    </section>
     <section class="content">


                
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th>#</th><th>Image</th><th>Product</th><th>Quantity</th><th>Price</th>
                                    </tr>
                                </thead>
                                	@foreach($orders as $order)
                                  	@foreach($order->cart->items as $item)
                                    <tr>
                                        <td>{{$order->order_no}}</td>
                                        <td>  <img src="{{asset('product/' .$item['image'])}}" alt="" width="60px" height="60px" /></td>
                                        <td> {{strtoupper($item['item']['name'])}}</td>
                                        <td> {{$item['qty']}}</td>
                                        <td>{{$item['price']}}</td>

                                    </tr>

                                @endforeach
                              @endforeach


                            </table>

                        </div>




        </section>
    </div>
@endsection
