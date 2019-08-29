@extends('Frontend.masterfrontend')

@section('content')

	<section id="cart_items">
		<div class="container">
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
				
				
				<ul class="nav">
					@foreach($addresses as $address)
					<li> 
					<input type="radio" value="{{$address->id}}" name="address" id="address{{$address->id}}"><label class="label label-primary ">Name: {{$address->fullname}},Addtess: {{$address->address1}},{{$address->address2}},zipcode: {{$address->zipcode}},PhoneNo: {{$address->phoneno}},MobieNo: {{$address->mobileno}}</label>
					</li> <br><br>
					@endforeach
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
	       <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest{{$data}}</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						  
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name" value="{{Auth::user()->name}}  {{Auth::user()->lastname}}">
								
								<input type="text" placeholder="User Name" value="{{Auth::user()->email}}">
								
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
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
								<form action="{{url('saveorder')}}" method="post">
									       {{ csrf_field() }}
									<input type="text" name="fullname" placeholder="Full Name *">								
									<input type="text" name="address1" placeholder="Address 1 *">
									<input type="text"name="address2" placeholder="Address 2">       							<input type="text" name="zipcode" placeholder="Zip / Postal Code *">
									<input type="text" name="country" placeholder=" Country*">
									<input type="text" name="stae" placeholder="State / Province / Region*">
								
									<input type="text" name="phoneno" placeholder="Phone *">
									<input type="text" name="mobileno" placeholder="Mobile Phone">
									

									<input type="submit" name="submit" class="btn btn-primary">
								</form>
							</div>
							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
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
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="cart_delete"></td>
						</tr>
					</thead>
					<tbody>
					@foreach($products as $product)

						<tr>
							
							<td class="cart_description">
								<h4><a href="">{{$product['item']['name']}}</a></h4>
								<p></p>
							</td>
							<td class="cart_price">
								<p>{{$product['price']}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{url('add/'.$product['item']['id'])}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$product['qty']}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="{{url('reduce/'.$product['item']['id'])}}"> - </a>
								</div>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('remove/'.$product['item']['id'])}}"><i class="fa fa-times"></i></a> 
							</td>
						</tr>

                     @endforeach
                     
                    
                       <tr>
							<td colspan="2">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>{{ $totalPrice}}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>@if($totalPrice>500)
                                              50
                                            @else
                                              Free
                                            @endif
										   </td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span> @if($totalPrice>500)
											          {{$shipTotalPrice}}
											        @else
											        {{ $total <=0 ? $totalPrice : $total }}</span>
                                                     @endif
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
</section>





	<section id="do_action" >
	  <div class="container" >
			
		 <div class="row"  >
				<div class="col-sm-7">
				
			     
					<div class="chose_area">
						<ul class="user_option">

								<label>Use Coupon Code</label>
								<form action="{{url('coupon')}}" method="post">
									{{ csrf_field() }}
								   <input type="text" id="text" name="coupon" style="display:block;">
								     @if($message = Session::get('message'))

                                     <div class="alert alert-danger">
                                     <button type="button" class="close" data-dismiss="alert">×</button>    
                                      <p>{{$message}}</p>
                                       </div>
                                      @endif
								   <input type="text" name="total" value="{{ $totalPrice}}" style="display: none;">
								   <div >
								    <input type="submit" id="apply" name="Apply" value="Apply" class="btn btn-primary" style="display:block;">
								    <input type="reset" name="reset" value="Clear" id="clear" class="btn btn-primary" style="display: none;">
								    </div>
							    </form>
                                
							    @if(!empty($coupons))
							     <label class="label label-success">  Available Coupons </label> <br><br>
                        @foreach($coupons as $v)

                         
                      <label class="label label-info">{{ $v->code  }}</label>
                        @endforeach
                      @endif
						</ul>	
		     		</div>
				</div>
		
		
		<div class="col-sm-5">
	    	<div class="total_area">
			    <div class="payment-options">
			    	 <center><h4>Payment Options</h4> </center>
					<span>
						<label><input type="radio" name="Payment" id="cod" value="COD"> COD-Cash on Delivery</label>

					</span>
					<button class="btn btn-primary" id="codbtn" style="float: left;display: none;">COD</button>
					<span>
						<label><input type="radio" name="Payment" id="Paypal" value="Paypal"> Paypal</label>

					</span>
						<form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
                              action="{!! URL::to('paypal') !!}">
					    	  {{ csrf_field() }}

					          <input type="text" name="amount" id="amount" value=" @if($totalPrice>500)
							 {{$shipTotalPrice}}    @else      {{ $total <=0 ? $totalPrice : $total }}  @endif" hidden />
                                 <button class="btn btn-primary" id="paybtn" style="float: left;display: none;">Pay with PayPal</button>
                        </form>                         
				</div>
		    </div>
	    </div>
	  </div>  
</div>
</section>

	

	


@endsection


@section('script')


@include('Frontend.cartjs')


@endsection
