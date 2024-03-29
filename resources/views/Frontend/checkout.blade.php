@extends('Frontend.masterfrontend')

@section('content')
@if($totalQty<=0)
<center><h2>Buy  Some Stuff</h2></center>
@else
<form action="{{url('paypal')}}" name="checkout" id="checkout"  method="post" data-parsley-validate>

 <section id="cart_items">
	<div class="container form-one" >

			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Saved Address</h2>
			</div>
			<div class="checkout-options">


				<ul class="nav user_address">
					@foreach($addresses as $address)
					<li data-id="{{$address->id}}">
				<label style="background: #F0F0E9;">	<input type="radio" value="{{$address->id}}" name="address" id="address{{$address->id}}">Name: {{$address->fullname}},Address: {{$address->address1}},{{$address->address2}},zipcode: {{$address->zipcode}},PhoneNo: {{$address->phoneno}},MobieNo: {{$address->mobileno}}</label>
					</li> <br><br>
					@endforeach
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
	       <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">

						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name" value="{{Auth::user()->name}}  {{Auth::user()->lastname}}"style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">

								<input type="text" placeholder="User Name" value="{{Auth::user()->email}}"style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">

							</form>
							<!-- <a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a> -->
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">

							<p>Bill To</p>
							<div>

								<form name="address" method="post">
								</form>
							</div>

							<div class="form-one" id="addressData">

									       {{ csrf_field() }}
                         {!!Form::label('Fullname')!!}
                         {!!Form::text('fullname',null,['placeholder'=>'Eg. ABC XYZ','class'=>'address-form','required'=>'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change'])!!}
                         {!!Form::label('Address1')!!}
                         {!!Form::text('address1',null,['placeholder'=>'Eg. ABC street','class'=>'address-form','required'=>'required'])!!}
                         {!!Form::label('Address 2')!!}
                         {!!Form::text('address2',null,['placeholder'=>'Eg.  xy path ','class'=>'address-form'])!!}
                         {!!Form::label('Zipcode')!!}
                         {!!Form::text('zipcode',null,['placeholder'=>'Eg. 432 564','class'=>'address-form','required'=>'required','data-parsley-type'=>'number','data-parsley-pattern'=>'/^\d{6}$/','data-parsley-trigger'=>'change'])!!}
                         {!!Form::label('Country')!!}
                         {!!Form::text('country',null,['placeholder'=>'Eg. India','class'=>'address-form','required'=>'required'])!!}
                         {!!Form::label('State')!!}
                         {!!Form::text('state',null,['placeholder'=>'Eg. Maharashtra','class'=>'address-form','required'=>'required'])!!}
                         {!!Form::label('PhoneNo')!!}
                         {!!Form::text('phoneno',null,['placeholder'=>'Eg. 123456 ','class'=>'address-form'])!!}
                         {!!Form::label('MobieNo')!!}
                         {!!Form::text('mobileno',null,['placeholder'=>'Eg. 9876543210','class'=>'address-form','required'=>'required','data-parsley-type'=>'number','data-parsley-pattern'=>'/^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/','data-parsley-trigger'=>'change'])!!}






							</div>

						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea   placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<!-- <label><input type="checkbox"> Shipping to bill address</label> -->
						</div>
					</div>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				@if(Session::has('cart'))
				 <table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
              <td class="total">Total </td>
							<td class="cart_delete"></td>
						</tr>
					</thead>
					<tbody>

					@foreach($products as $product)

						<tr>
							<td class="cart_product">
								<a href=""><img src="{{('http://laraveldemoimageupload.s3.ap-south-1.amazonaws.com/product/'.$product['image'])}}" alt="" width="60px" height="60px"></a>

							</td>
							<td class="cart_description">
								<h4 style="margin-top: 25px;"><a href="">{{$product['item']['name']}}</a></h4>

							</td>
							<td class="cart_price">
								<p style="margin-top: 25px;"><i class="fa fa-inr"></i> {{$product['item']['price']}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button" style="margin-top: 25px;">
									<a class="cart_quantity_up" data-id="{{$product['item']['id']}}" href="{{url('add/'.$product['item']['id'])}}" > + </a>

									<input class="cart_quantity_input" type="text"  value="{{$product['qty']}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="{{url('reduce/'.$product['item']['id'])}}"> - </a>
								</div>
							</td>
              <td class="cart_price">
                <p style="margin-top: 25px;"><i class="fa fa-inr"></i>{{$product['price']}} </p>
              </td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('remove/'.$product['item']['id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

                     @endforeach


                       <tr>
							<td colspan="3">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td><i class="fa fa-inr"></i> {{ $totalPrice}}  </td>

									</tr>
									<tr>
										<td>Exo Tax</td>
										<td><i class="fa fa-inr"></i> 0</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>@if($totalPrice<=500)
                  <i class="fa fa-inr"></i>  50
                          @else
                          Free
                        @endif
										   </td>
									</tr>
									<tr>
										<td>Total</td>
										<td>


										<i class="fa fa-inr"></i>	{{$shipTotalPrice}}
											    </td>

									</tr>
								</table>
							</td>
						</tr>
					</tbody>

				 </table>

				@else
                 <h2>Do Something for you</h2>
				@endif
			</div>




			<div class="rows">
				<div class="col-md-8 chose_area" style="border: 1px,solid,black;">
					<H3>Coupons Apply</H3>
					<div class="col-md-3" style="float: left;">
					   <form action="{{url('coupon')}}" method="post">
                        {{ csrf_field() }}
                        <input type="text" id="couponcode" name="coupon"  placeholder="Applycode..." value="{{request('coupon')}}" style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
                            @if($message = Session::get('message'))

                               <div class="alert alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                 <p>{{$message}}</p>
                               </div>
                            @endif
                          <input type="text" name="total" value="{{ $totalPrice}}" style="display: none;">
                            <div >
                              <input type="submit" id="apply" name="Apply" value="Apply" class="btn btn-primary" style="display:block;">
                              <a href="{{url('removecoupon')}}" id="clear" class="btn btn-primary" style="display: none;">Remove</a>
                            </div>
                       </form>
                   </div>

                     <div class="col-md-5 coupon_code" style="float: left;">

                       @if(!empty($coupons))
                                 <label class="label label-success">  Available Coupons </label> <br><br>
                        @foreach($coupons as $v)
                         <span class="badge" style="color:black;margin:1px;display:inline;">
                         <input type="radio" class="coupon_code" name="coupon" id="coupon{{$v->id}}" value="{{$v->code}}" data-id="{{$v->code}}">
                      {{ $v->code  }}</span> &nbsp;
                        @endforeach
                      @endif
                     </div>
				</div>
				<div class="col-sm-4">
					<H3>Payment Option</H3>
					<label><input type="radio" name="PaymentMode" id="cod" value="COD">COD</label>
          <label><input type="radio" name="PaymentMode" id="Paypal" value="Paypal"> Paypal</label>
				</div>
		    </div>





			<input type="text" name="amount" id="amount" value="{{$shipTotalPrice}}" hidden />
			 <input type="submit" name="submit" value="Proceed"class="btn btn-primary" id="codbtn" formaction="{{url('saveorder')}}" style="float: left;display: none;">
        <input type="submit" name="submit" value="Proceed" id="paybtn" class="btn btn-primary" style="float: left;display: none;">





    </form>

   </div>
  </section>

@endif

@endsection
@section('script')
<script>
$(document).ready(function(){
  $('.cart_quantity_up').click(function(e){
    var id = $(this).attr("data-id");
    $.ajax({
    type:'post',
     dataType:'html',
     headers: {
                   'X-CSRF-Token': token
              },
     url:'/add/'+id,
      success:function(responce){
       console.log(responce);
      }
   });
      alert(id);
  });
  //
  // $('.cart_quantity_down').click(function(e){
  //     alert('down');
  // });
  // $('#apply').click(function(e){
  //   var id = $("#couponcode").val();
  //   $.ajax({
  //   type:'Post',
  //    dataType:'html',
  //    url:'/coupon/',
  //    data:{
	// 						code: $('#coupon_code').val()
	// 					},
  //     success:function(responce){
  //      console.log(responce);
  //     }
  //  });
  //     alert(id);
  // });

});

</script>

@endsection
