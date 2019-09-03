@extends('Frontend.masterfrontend')

@section('content')


 <!-- @foreach($wishlists as $p)

      {{$p->product}}
     {{$p->product->image}}
     @foreach($p->product->image as $image)
        {{$image->image_path}}
      @endforeach

 @endforeach -->
        <div class="breadcrumbs">
  				<ol class="breadcrumb">
  				  <li><a href="{{url('/')}}">Home</a></li>
  				  <li class="active">Wish list</li>
  				</ol>
  			</div><!--/breadcrums-->

         <h3 style="color: #777;padding-bottom: 6px;text-align: -webkit-center;text-align:-moz-center;">My Wishlist</h3>
            <!-- <div class="row" style="padding-top:5px;margin-bottom: 6px;" >

             @foreach($wishlists as $wish)
						  <div class="row">
						   	 <div class="col-sm-4"></div>
						      <div class="col-sm-1">
                     @foreach($wish->product->image as $image)
                     @endforeach
							      	<a href=""><img src="{{asset('product/' .$image->image_path)}}" alt="" width="70px" height="70px" /></a>
							     </div>

                  <div class="col-sm-3">
                    <p>  <a href="{{url('productdetails/'.$wish->product->id)}}">{{$wish->product->name}}</a>
                       {{$wish->product->description}} {{$wish->product->attribute->color}}</p>
							      	 &#8377;. {{$wish->product->price}}
							     </div>
							  <div class="col-sm-4">
							     	<a href="{{url('add-to-cart/'.$wish->product->id)}}" class="btn btn-sm-default cart"><i class="fa fa-shopping-cart"></i>
										Add to cart</a>
							    	<a onClick="javascript: return confirm('Are you sure to delete it .');" href="{{url('removeproduct/'.$wish->product->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>
										Remove</a>
							  </div>

              </div> <br>

           @endforeach


         </div>
 -->


         <div>

   				 <table class="table table-condensed">
   					<thead>
   						<tr>
                <td style="width:5%;"></td>
   							<td></td>
   							<td></td>
   							<td></td>
   						</tr>
   					</thead>
   					<tbody>
   					 @foreach($wishlists as $wish)

   						<tr>
                <td></td>
   							<td>
                  @foreach($wish->product->image as $image)
                  @endforeach
                   <a href="{{url('productdetails/'.$wish->product->id)}}"><img src="{{asset('product/' .$image->image_path)}}" alt="" width="70px" height="70px" /></a>

   							</td>

   							<td>
                  <p>  <a href="{{url('productdetails/'.$wish->product->id)}}">{{$wish->product->name}}</a>
                     {{$wish->product->description}} {{$wish->product->attribute->color}}</p>
                     &#8377;. {{$wish->product->price}}
   							</td>
   							<td>
                  <a href="{{url('add-to-cart/'.$wish->product->id)}}" class="btn btn-sm-default cart"><i class="fa fa-shopping-cart"></i>
                  Add to cart</a>

                  <a onClick="javascript: return confirm('Are you sure to delete it .');" href="{{url('removeproduct/'.$wish->product->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>
                  Remove</a>

   							</td>


   						</tr>
              @endforeach
   					</tbody>

   				 </table>


   			</div>






@endsection
