@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
      <h2>Change status</h2>

        <div class="pull-right">
            <a href="{{ url('/admin/order') }}" title="Back"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
             </div>
     </section>
     <section class="content">



                        <form id="order-form" method="post" action="{{ url('/admin/order/' . $order->id) }}"  accept-charset="UTF-8" enctype="multipart/form-data">
                             {{method_field('PATCH')}}
                            {{ csrf_field() }}
                               <div class="row">

                                 <div class="table-responsive">
                                     <table class="table">
                                         <thead>
                                             <tr>
                                                <th>#</th><th>Product</th><th>Quantity</th><th>Price</th>
                                             </tr>
                                         </thead>
                                             @foreach($orders->items as $item)
                                             <tr>
                                                 <td><img src="{{asset('product/' .$item['image'])}}" alt="" width="60px" height="60px" /></td>
                                                 <td> {{$item['item']['name']}}</td>
                                                 <td> {{$item['qty']}}</td>
                                                 <td>{{$item['price']}}</td>
                                             </tr>
                                            @endforeach

                                        </table>

                                 <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                 <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                                     <label for="type" class="control-label">{{ 'Status' }}</label>
                                     <select class="form-control" name="status" data-parsley-required>
                                        @foreach($enumoption as $option)
                                          <option value="{{$option}}"@if($order->status==$option) selected="selected" @endif >{{$option}}</option>
                                        @endforeach
                                     </select>

                                     {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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
