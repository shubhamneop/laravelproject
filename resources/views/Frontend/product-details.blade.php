@extends('Frontend.masterfrontend')

@section('content')



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

										<a data-toggle="collapse" data-parent="#accordian" id="#{{$item->id}}"    href="#{{$item->id}}">{{$item->category_name}}
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>

										</a>


									</h4>
								</div>
								<div id="{{ $item->id }}" class="panel-collapse collapse">
									<div class="panel-body">
										@foreach($item->childs as $sub)
										<ul>
											<li><a href="{{url('categories/'.$sub->id)}}">{{$sub->category_name}} </a></li>

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
									@foreach($categorycounts as $productcount)
									<li><a href="#"> <span class="pull-right">({{$productcount->total}})</span>{{$productcount->categories->category_name}}</a></li>
									@endforeach

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
				@foreach($productsDetails->image as $image)
                  @endforeach
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{asset('product/' .$image->image_path)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">

								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
									  	<div class="item active">
									   		@foreach($productsDetails->image as $image)
											   <a href=""><img src="{{asset('product/' .$image->image_path)}}" alt="" width="85px" height="85px"/></a>
                                            @endforeach


									 	</div>
									 	<div class="item">
										  @foreach($productsDetails->image as $image)
											  <a href=""><img src="{{asset('product/' .$image->image_path)}}" alt="" width="85px" height="85px" /></a>
                                            @endforeach
										</div>
										<div class="item">
										 @foreach($productsDetails->image as $image)
											  <a href=""><img src="{{asset('product/' .$image->image_path)}}" alt="" width="85px" height="85px" /></a>
                                            @endforeach
										</div>

									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$productsDetails->name}}</h2>
								<p>Web ID: ab{{$productsDetails->id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span><i class="fa fa-inr"></i> {{$productsDetails->price}}</span>
									<label>Quantity:</label>
									<input type="text" value="{{$productsDetails->attribute->quantity}}" />
                   @if($productsDetails->attribute->quantity<=0)
									<a href="{{url('add-to-cart/'.$productsDetails->id)}}" class="btn btn-fefault cart" disabled><i class="fa fa-close"></i>
										Add to cart</a>
										@else
										<a href="{{url('add-to-cart/'.$productsDetails->id)}}" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>
											Add to cart</a>
										@endif
								</span>
							  	@if($productsDetails->attribute->quantity<=0)
							    <p><b>Availability:</b> Out of Stock</p>
								  @else
								 <p><b>Availability:</b> In Stock</p>
								 @endif
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> E-SHOPPER</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div>
					 <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#reviews" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#details" data-toggle="tab">Tag</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{asset('frontend/images/home/gallery1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>

												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{asset('frontend/images/home/gallery4.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>{{$productsDetails->description}}.</p>
									<p><b>Write Your Review</b></p>

									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>


				</div>
			</div>
		</div>




@endsection


@section('script')
@include('Frontend.productjs')


@endsection
