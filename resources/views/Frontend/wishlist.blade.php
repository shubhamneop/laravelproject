@extends('Frontend.masterfrontend')

@section('content')

        <div class="breadcrumbs">
  				<ol class="breadcrumb">
  				  <li><a href="{{url('/')}}">Home</a></li>
  				  <li class="active">Wish list</li>
  				</ol>
  			</div><!--/breadcrums-->

         <h3 style="color: #777;padding-bottom: 6px;text-align: -webkit-center;text-align:-moz-center;">My Wishlist</h3>
    
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
                  @foreach($wish->image as $image)
                  @endforeach
                   <a href="{{url('productdetails/'.$wish->id)}}"><img src="{{asset('product/' .$image->image_path)}}" alt="" width="70px" height="70px" /></a>

   							</td>

   							<td>
                  <p>  <a href="{{url('productdetails/'.$wish->id)}}">{{$wish->name}}</a>
                     {{$wish->description}} {{$wish->attribute->color}}</p>
                     &#8377;. {{$wish->price}}
   							</td>
   							<td>
                  <a href="{{url('add-to-cart/'.$wish->id)}}" class="btn btn-sm-default cart"><i class="fa fa-shopping-cart"></i>
                  Add to cart</a>

                  <a onClick="javascript: return confirm('Are you sure to delete it .');" href="{{url('removeproduct/'.$wish->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>
                  Remove</a>

   							</td>


   						</tr>
              @endforeach
   					</tbody>

   				 </table>


   			</div>






@endsection
