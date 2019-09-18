@extends('Frontend.masterfrontend')

@section('content')


      <div class="row">
				<div class="col-sm-12">
          <div class="breadcrumbs">
            <ol class="breadcrumb">
             <li><a href="{{url('/')}}">Home</a></li>
             <li class="active">Track Order</li>
            </ol>
              </div><!--/breadcrums-->
          </div>
	     </div>
      <div class="signup-form" style="position: relative;left: 311px;"><!--sign up form-->
      <h2 style="position: relative;left: 170px;">Track Order!</h2>
         <form action="{{url('trackorder')}}" method="post">
            {{csrf_field()}}



                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                            <label for="email" class="col-md-2 control-label">E-Mail Address</label>
                            <div class="col-md-3">

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('orderid') ? ' has-error' : '' }} row">
                          <label for="orderid" class="col-md-2 control-label">Order Id </label>
                          <div class="col-md-3">

                              <input id="orderid" type="text" class="form-control" name="orderid" value="{{ old('orderid') }}" required autofocus>

                              @if ($errors->has('orderid'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('orderid') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>




           <button type="submit" class="btn btn-default"  style="position: relative;left: 150px;">Track</button>
         </form>
       </div><!--/sign up form-->


           @if($data==null)
            <div style="width:auto;height:100px;font-size:25px;">  <center>Order details not found</center> </div>
           @else
          <div class="container" style="margin-bottom:100px;" >
            <div class="row text-center alert alert-info">
             <div class="col-md-4"><h3>Order No:  {{$data->id}}</h3> </div>
             <div class="col-md-4">
               @foreach($order->items as $item)
                <h3>   	<img src="{{asset('product/' .$item['image'])}}" alt=""  width="30px" height="30px" />
                {{$item['item']['name']}} | &#8377;{{$item['price']}}   </h3>
               @endforeach
             </div>

            <div class="col-md-4"><h3> Status: <mark>{{$data->status}}</h3></mark></div>
           </div>

               @if($data->status=="Pending")
               @include('Frontend.steps.pending')

               @elseif($data->status=="Processing")
               @include('Frontend.steps.processed')


               @elseif($data->status=="Dispatched")
               @include('Frontend.steps.dispatched')

                @elseif($data->status=="Shipped")
                @include('Frontend.steps.shipped')

                @elseif($data->status=="Delivered")
                @include('Frontend.steps.delivered')

                @elseif($data->status=="Cancelled")

              <h1 align="center">your order cancelled by admin</h1>

               @endif

          </div>
             @endif



        </div>

@endsection
