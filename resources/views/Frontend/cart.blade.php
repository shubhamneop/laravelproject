@extends('Frontend.masterfrontend')

@section('content')
@if($totalQty<=0)
<center><h2>Buy  Some Stuff</h2></center>
@else


	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
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
							 <a href=""><img src="{{asset('product/' .$product['image'])}}" alt="" width="60px" height="60px"></a>

						 </td>
						 <td class="cart_description">
							 <h4 style="margin-top: 25px;"><a href="">{{$product['item']['name']}}</a></h4>

						 </td>
						 <td class="cart_price">
							 <p style="margin-top: 25px;"><i class="fa fa-inr"></i> {{$product['item']['price']}}</p>
						 </td>
						 <td class="cart_quantity">
							 <div class="cart_quantity_button" style="margin-top: 25px;">
								 <a class="cart_quantity_up" href="{{url('add/'.$product['item']['id'])}}"> + </a>

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


					</tbody>
				</table>

				@else
                 <h2>Buy Some Stuff</h2>
				@endif
			</div>

	</section> <!--/#cart_items-->

	<section id="do_action">
		@if(Session::has('cart'))
		<div class="container">

			<div class="row">

				<div class="col-sm-7">
					<div class="total_area">

						<ul>

							<li>Cart Sub Total <span><i class="fa fa-inr"></i> {{ $totalPrice}}</span></li>
							<li>Eco Tax <span>0</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>
                          <i class="fa fa-inr"></i>  {{ $total <=0 ? $shipTotalPrice : $total }}
							</span></li>

						</ul>
							<a class="btn btn-default update" href="#">Update</a>
							<a class="btn btn-default check_out" href="{{url('check_out')}}">Check Out</a>

					</div>
				</div>
			</div>
		</div>
		@else

		@endif
	@endif
	</section><!--/#do_action-->
</div>
	@endsection


@section('script')


@include('Frontend.layouts.cartjs')


@endsection
