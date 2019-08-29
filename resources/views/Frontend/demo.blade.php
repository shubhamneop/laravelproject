@extends('Frontend.masterfrontend')

@section('content')

<section>
  @foreach($data->image as $image)
    	@endforeach
                          <div class="view-product">
								<img src="{{asset('product/' .$image->image_path)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
						
   
</section>




@endsection


@section('script')


@include('Frontend.cartjs')


@endsection