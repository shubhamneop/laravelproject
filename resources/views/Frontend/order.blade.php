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
           			<span class="badge">
           				{{$item['price']}}
           			</span>
           			{{$item['item']['name']}} | {{$item['qty']}} Item 
           		</li>
           		@endforeach
           	</ul>
           </div>
           <div class="panel-footer">
           	<strong>Total Price: {{$order->cart->shipTotalPrice}}</strong>
           </div>
        </div>

		@endforeach
	</div>
 
</div>



@endsection