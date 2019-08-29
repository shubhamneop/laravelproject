@extends('Frontend.masterfrontend')

@section('content')
	<section ><!--form-->

		<div class="content">
			<div class="row">
				<div class="col-xs-12 col-xs-12-offset-1">
         <div class="col-xs-4">
           <ul class="nav navbar-nav">
             <li class="dropdown"><a href="#"><i class="fa fa-user  dropdown-toggle" data-toggle="dropdown"></i> Account</a>
                <ul role="menu" class="sub-menu" style="background:transparent;width: 108px; color:black;">
                <li><a href="{{url('addresses')}}" style="color: black;"><i class="fa fa-star"></i>Address</a></li>
                <li><a href="#" style="color: black;"><i class="fa fa-shopping-basket"></i>Order</a></li>
                <li><a href="#" style="color:black;"><i class="fa fa-key"></i>Change Password</a></li>
              </ul>

            </li>


         </ul>
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
						<form action="{{url('profileupdate')}}" method="post">
							 {{csrf_field()}}

                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                               <label for="name" class="col-md-2 control-label">Name</label>
                               <div class="col-md-6">
                               @if(!empty($name))
                                   <input id="name" type="text" class="form-control" name="name" value="{{$name}}" required autofocus>
                               @else
                                   <input id="name" type="text" class="form-control" name="name" value="{{ $profile->name }}" required autofocus>
                               @endif
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
														 @if(!empty($lasname))
																 <input id="lasname" type="text" class="form-control" name="lastname" value="{{$lastname}}" required autofocus>
														 @else
																 <input id="lasname" type="text" class="form-control" name="lastname" value="{{ $profile->lastname }}" required autofocus>
														 @endif
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
                                   @if(!empty($email))
                                   <input id="email" type="email" class="form-control" name="email" value="{{$email}}" required>
                                   @else
                                   <input id="email" type="email" class="form-control" name="email" value="{{ $profile->email }}" required>
                                   @endif
                                   @if ($errors->has('email'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                        <!-- <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                               @if ($errors->has('password'))
                                    <span class="help-block">
                                           <strong>{{ $errors->first('password') }}</strong>
                                       </span>
                                 @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->
							<button type="submit" class="btn btn-default"><i class="fa fa-edit"></i>Update</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
