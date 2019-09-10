@extends('Frontend.masterfrontend')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>My Orders</h1>
		@foreach($orders as $order)
         <div class="panel panel-default">

           <div class="panel-body">
           	<ul class="list-group">
           		@foreach($order->cart->items as $item)
           		<li>
								<img src="{{asset('product/' .$item['image'])}}" alt=""  width="60px" height="60px" />

           			{{$item['item']['name']}} | {{$item['qty']}} Item
								<span class="badge">
									&#8377; {{$item['price']}}
								</span>
           		</li>

           		@endforeach

           	</ul>
           </div>
           <div class="panel-footer">

           	<strong>Total Price: {{$order->cart->shipTotalPrice}}</strong>
						 <strong style="float:right;">Status: {{$order->status}}</strong>
           </div>

        </div>

		@endforeach
	</div>

</div>




@endsection
