@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <center><h2>Change status  #{{ $order->id }}</h2></center>
        <h2><a href="{{ url('/admin/order') }}" class="btn btn-primary" > <i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></h3>




     </section>
     <section class="content">




                        <form id="order-form" method="post" action="{{ url('/admin/order/' . $order->id) }}"  accept-charset="UTF-8" enctype="multipart/form-data">
                             {{method_field('PATCH')}}
                            {{ csrf_field() }}
                               <div class="row">
                                 @foreach($orders->items as $item)
                                 <div class="col-xs-4 col-sm-4 col-md-4 form-group">
                                 <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                     <label for="title" class="control-label">{{ 'Name' }}</label>
                                     <label class="form-control"  id="name" >{{$item['item']['name']}}</label>

                                 </div>
                                 </div>
                                 <div class="col-xs-4 col-sm-4 col-md-4 form-group">
                                 <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                                     <label for="code" class="control-label">{{ 'Quantity' }}</label>
                                     <label class="form-control" id="qty" >{{$item['qty']}}</label>

                                 </div>
                                 </div>
                                 <div class="col-xs-4 col-sm-4 col-md-4 form-group">
                                 <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                                     <label for="code" class="control-label">{{ 'Price' }}</label>
                                     <label class="form-control"   id="price" >{{$item['price']}}</label>

                                 </div>
                                 </div>

                                 @endforeach
                                 <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                 <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                                     <label for="type" class="control-label">{{ 'Status' }}</label>
                                     <select class="form-control" name="status" data-parsley-required>



                                  <option value="{{$order->status}}"selected>
                                    {{$order->status}}
                                  </option>
                                     <option value="dispatched">dispatched</option>
                                       <option value="shipped">shipped</option>
                                      <option value="delivered">delivered</option>
                                      <option value="cancelled">cancelled</option>
                                     </select>

                                     {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                                 </div>
                                 <input type="submit" class="btn btn-primary" value="Submit">
                                 </div>
                               </div>
                        </form>


        </section>
      </div>
@endsection
@section('script')
  <script type="text/javascript">
      $(document).ready(function() {
           $("#coupon-form").parsley();
               });
  </script>

  <script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>
@endsection
