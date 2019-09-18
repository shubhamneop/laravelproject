@extends('Frontend.masterfrontend')

@section('content')
<section id="slider"><!--slider-->
<div class="container">
<div class="row">
<div class="col-sm-12">
	<div id="slider-carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
			<li data-target="#slider-carousel" data-slide-to="1"></li>
			<li data-target="#slider-carousel" data-slide-to="2"></li>
		</ol>

		<div class="carousel-inner">

				@foreach($banner as $key => $slider)
			<div class="item {{$key == 0 ? 'active' : '' }}">
				<div class="col-sm-6">
					<h1><span>E</span>-SHOPPER</h1>
					<h2>Free E-Commerce Template</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
					<button type="button" class="btn btn-default get">Get it now</button>
				</div>
				<div class="col-sm-6">
					<img src="{{asset('/storage/' .$slider->bannername)}}" class="girl img-responsive" alt="" />
					<img src="{{asset('frontend/images/home/pricing.png')}}"  class="pricing" alt="" />
				</div>
			</div>
				@endforeach


			</div>




		<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>
	</div>
		</div>
	</div>


</div>

</section><!--/slider-->


		   	<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category  </h2>

                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<!--  <a data-parent="#accordian" href="{{url('/')}}">All Product</a> -->
								 @foreach($category as $item)

								<div class="panel-heading">

									<h4 class="panel-title">

										<a data-toggle="collapse" data-parent="#accordian" id="#{{$item->id}}"  href="#{{$item->id}}">{{$item->category_name}}
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>

										</a>


									</h4>
								</div>
								<div id="{{ $item->id }}" class="panel-collapse collapse">
									<div class="panel-body">
										@foreach($item->childs as $sub)
										<ul>
											<li><a href="{{url('categories/'.$sub->id)}}">{{$sub->category_name}} </a></li>
											<ul>
											<!-- @foreach($sub->childs as $subcat)
                                              <li id="cat{{$subcat->id}}" value="{{$subcat->id}}">{{$subcat->category_name}} </li>

											@endforeach -->
										   </ul>
										</ul>
										@endforeach
									</div>
								</div>
              @endforeach

							</div>

						</div><!--/category-products-->

					   <!--  <div>
					     	<ul class="list">
                  			 @foreach($category as $item)
                                  <li data-toggle="collapse" data-parent="#accordian" class="option" id="cat{{$item->id}}" value="{{$item->id}}">{{$item->category_name}}<span class="badge pull-right"><i class="fa fa-plus"></i></span> </li>
                             @endforeach
                         </ul>


					     </div>  -->


						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->

						<div class="shipping text-center"><!--shipping-->
							<img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
						</div><!--/shipping-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">


					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>





						@foreach($products as $product)

						<div class="col-sm-4">
					 <div class="product-image-wrapper">
						 <div class="single-products">
								 <div class="productinfo text-center">
                   @foreach($product->image as $image)
									 @endforeach
									 <img src="{{asset('product/' .$image->image_path)}}" alt="" width="268px" height="249px"/>
									 <h2><i class="fa fa-inr"></i>  {{ $product->price }}</h2>
									 <p>{{ strtoupper($product->name) }}</p>
									 <a href="{{url('add-to-cart/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								 </div>
								 <div class="product-overlay">
									 <div class="overlay-content">

									 <h2><i class="fa fa-inr"></i>  {{ $product->price }}</h2>
									 <p>{{ strtoupper($product->name)}}<p>
										 <a href="{{url('add-to-cart/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										 <a href="{{url('productdetails/'.$product->id)}}" class="btn btn-default cart"><i class="fa fa-plus-square"></i>Product Details</a>
									 </div>
								 </div>
						 </div>
						 <div class="choose">
							 <ul class="nav nav-pills nav-justified">
								 <li><a href="{{url('add-to-wishlist/'.$product->id)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								 <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
							 </ul>
						 </div>
					 </div>
				 </div>

						@endforeach


					</div><!--features_items-->

					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								@foreach($subcategory as $child)
                  <li class=""><a href="#{{$child->category_name}}" id="{{$child->id}}" data-toggle="tab">{{$child->category_name}}</a></li>
								@endforeach

							</ul>
						</div>
						<div class="tab-content">

							<div class="tab-pane fade active in" id="productData" >

							</div>
						</div>


					</div><!--/category-tab-->

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/home/recommend1.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/home/recommend2.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/home/recommend3.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/home/recommend1.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/home/recommend2.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/home/recommend3.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
						</div>
					</div><!--/recommended_items-->

				</div>
			</div>
		</div>




@endsection


@section('script')
@include('Frontend.productjs')


@endsection
