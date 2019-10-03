@extends('Frontend.masterfrontend')

@section('content')
	<section ><!--form-->

		<div class="content">
			<div class="row">
				<div class="col-xs-12 col-xs-12-offset-1">
         <div class="col-xs-4">
           <!-- <ul class="nav navbar-nav">
             <li class="dropdown"><a href="#"><i class="fa fa-user  dropdown-toggle" data-toggle="dropdown"></i> Account</a>
                <ul role="menu" class="sub-menu" style="background:transparent;width: 108px; color:black;">
                <li><a href="{{url('addresses')}}" style="color: black;"><i class="fa fa-star"></i>Address</a></li>
                <li><a href="#" style="color: black;"><i class="fa fa-shopping-basket"></i>Order</a></li>
                <li><a href="#" style="color:black;"><i class="fa fa-key"></i>Change Password</a></li>
              </ul>

            </li>
         </ul> -->
				 <div>
				 	<img src="{{asset('User_profile/' .$profile->profile_image)}}" alt="User Profile" width="110px" height="110px" style="border: 3px solid #d2d6de; border-radius: 50px;padding:3px; position: relative;top:70px;left: 138px;margin-bottom:5px; "/>
					  <h3 style="font-size: 21px;margin-top: 5px;text-align: center;font-family: 'Source Sans Pro',sans-serif;position: relative;top: 70px;    left: 18px">{{$profile->name}} {{$profile->lastname}} </h3>
            <form id="imageupload" action="{{url('imageupload')}}" enctype="multipart/form-data" method="post">
							 {{csrf_field()}}
				      <input id="profile" type="file" class=" @error('profile') is-invalid @enderror" name="profile" required style="position: relative;  top: 70px;  left: 119px;width: 88px;">
							<input type="submit" name="submit" value="Upload" style="position: relative;top: 47px;left: 213px">
				  	</form>
					</div>
				 </div>
				<div class="col-xs-8">
					<div class="signup-form"><!--sign up form-->
						<h2>My Profile!</h2>
            @if($message = Session::get('success'))

                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                      <p>{{$message}}</p>
               </div>
            @endif
						{!! Form::open(array('url'=>'profileupdate','method'=>'post','enctype'=>'multipart/form-data','data-parsley-validate'))!!}
							 {{csrf_field()}}

                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                               <label for="name" class="col-md-2 control-label">Name</label>
                               <div class="col-md-6">
																 {!! Form::text('name',$profile->name,['class'=>'form-control','id'=>'name','data-parsley-required','data-parsley-pattern'=>'^[a-zA-Z]+$'])!!}

                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>
													 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
														 <label for="name" class="col-md-2 control-label">Lastname</label>
														 <div class="col-md-6">
                                {!! Form::text('lastname',$profile->lastname,['class'=>'form-control','id'=>'lastname','data-parsley-required','data-parsley-pattern'=>'^[a-zA-Z]+$'])!!}

																 @if ($errors->has('lastname'))
																		 <span class="help-block">
																				 <strong>{{ $errors->first('lastname') }}</strong>
																		 </span>
																 @endif
														 </div>

													 </div>

                           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                               <label for="email" class="col-md-2 control-label">E-Mail Address</label>
                               <div class="col-md-6">

																	 {!! Form::email('email',$profile->email,['id'=>'email','class'=>'form-control','data-parsley-required'])!!}
                                   @if ($errors->has('email'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

												{{ Form::button('<i class="fa fa-edit"></i>Update', ['class' => 'btn  btn-default', 'type' => 'submit']) }}

						{!!Form::close() !!}


					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection

@section('script')

<script type="text/javascript">
$(function () {
		$('#profile').parsley();
});
</script>
<script src="https://code.jquery.com/jquery-3.4.1.js"
integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>


@endsection
