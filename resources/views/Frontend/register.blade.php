@extends('Frontend.masterfrontend')

@section('content')
	<section style="margin-left: 25%;"><!--form-->

		<div class="content">
			<div class="row">
				<div class="col-xs-12 col-xs-12-offset-1">

				<div class="col-xs-12">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{url('register')}}" method="post">
							 {{csrf_field()}}

                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                               <label for="name" class="col-md-4 control-label">Name</label>
                               <div class="col-md-6">
                               @if(!empty($name))
                                   <input id="name" type="text" class="form-control" name="name" value="{{$name}}" required autofocus>
                               @else
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                               @endif
                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>
													 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
														 <label for="name" class="col-md-4 control-label">Lastname</label>
														 <div class="col-md-6">
														 @if(!empty($lasname))
																 <input id="lasname" type="text" class="form-control" name="lastname" value="{{$lastname}}" required autofocus>
														 @else
																 <input id="lasname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>
														 @endif
																 @if ($errors->has('lastname'))
																		 <span class="help-block">
																				 <strong>{{ $errors->first('lastname') }}</strong>
																		 </span>
																 @endif
														 </div>

													 </div>

                           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                               <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                               <div class="col-md-6">
                                   @if(!empty($email))
                                   <input id="email" type="email" class="form-control" name="email" value="{{$email}}" required>
                                   @else
                                   <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                   @endif
                                   @if ($errors->has('email'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                        <div class="form-group row">
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
                        </div>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
