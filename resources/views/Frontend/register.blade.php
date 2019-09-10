@extends('Frontend.masterfrontend')

@section('content')
	<section style="margin-left: 25%;"><!--form-->

		<div class="content">
			<div class="row">
				<div class="col-xs-12 col-xs-12-offset-1">

				<div class="col-xs-12">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{url('register')}}" method="post" data-parsley-validate>
							 {{csrf_field()}}

                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                               <label for="name" class="col-md-4 control-label">Name</label>
                               <div class="col-md-6">
                               @if(!empty($name))
                                   <input id="name" type="text" class="form-control" name="name" value="{{$name}}" required autofocus placeholder='First Name' data-parsley-required-message ='First name is required'  data-parsley-trigger='change'
											             data-parsley-pattern= '/^[a-zA-Z]*$/'
											             data-parsley-minlength ='2'
											              data-parsley-maxlength='32'>
                               @else
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder='First Name' data-parsley-required-message ='First name is required'  data-parsley-trigger='change'
											             data-parsley-pattern= '/^[a-zA-Z]*$/'
											             data-parsley-minlength ='2'
											              data-parsley-maxlength='32'>
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
																 <input id="lasname" type="text" class="form-control" name="lastname" value="{{$lastname}}" required autofocus placeholder='Last Name' data-parsley-required-message ='Last name is required'  data-parsley-trigger='change'
																 data-parsley-pattern= '/^[a-zA-Z]*$/'
																 data-parsley-minlength ='2'
																	data-parsley-maxlength='32'>
														 @else
																 <input id="lasname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus placeholder='Last Name' data-parsley-required-message ='Last name is required'  data-parsley-trigger='change'
																 data-parsley-pattern= '/^[a-zA-Z]*$/'
																 data-parsley-minlength ='2'
																	data-parsley-maxlength='32'>
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
                                   <input id="email" type="email" class="form-control" name="email" value="{{$email}}" required placeholder='Email id' data-parsley-required-message ='E-Mail  is required'  data-parsley-trigger='change'
																	 data-parsley-type= 'email'
																	 data-parsley-minlength ='2'
																		data-parsley-maxlength='32'>
                                   @else
                                   <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder='Email id' data-parsley-required-message ='E-Mail  is required'  data-parsley-trigger='change'
																	 data-parsley-type= 'email'
																	 data-parsley-minlength ='2'
																		data-parsley-maxlength='32'>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder = 'Password',
                                     data-parsley-required-message = 'Password is required' data-parsley-trigger = 'change focusout'
                                       data-parsley-uppercase='1'
                                      data-parsley-lowercase='1'  data-parsley-number='1' data-parsley-special='1'>

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder = 'Confirm Password',
                                     data-parsley-required-message = 'Password is required' data-parsley-trigger = 'change focusout' data-parsley-equalto='#password' data-parsley-uppercase='1'
                                      data-parsley-lowercase='1'  data-parsley-number='1' data-parsley-special='1'>
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
@section('script')
 <script>
	$(document).ready(function(){

 window.Parsley.addValidator('uppercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var uppercases = value.match(/[A-Z]/g) || [];
    return uppercases.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) uppercase letter.'
  }
  });

//has lowercase
  window.Parsley.addValidator('lowercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var lowecases = value.match(/[a-z]/g) || [];
    return lowecases.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) lowercase letter.'
  }
  });

//has number
  window.Parsley.addValidator('number', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var numbers = value.match(/[0-9]/g) || [];
    return numbers.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) number.'
  }
  });

//has special char
 window.Parsley.addValidator('special', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var specials = value.match(/[^a-zA-Z0-9]/g) || [];
    return specials.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) special characters.'
  }
 });

  });
 </script>
@endsection
