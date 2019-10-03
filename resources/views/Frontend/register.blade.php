@extends('Frontend.masterfrontend')

@section('content')
	<section style="margin-left: 25%;"><!--form-->

		<div class="content">
			<div class="row">
				<div class="col-xs-12 col-xs-12-offset-1">

				<div class="col-xs-12">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						{!! Form::open(array('url'=>'register','method'=>'post','data-parsley-validate'))!!}

							 {{csrf_field()}}

                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                               <label for="name" class="col-md-4 control-label">Name</label>
                               <div class="col-md-6">
                               @if(!empty($name))
															  {!! Form::text('name',$name,[
					                                 'class'     => 'form-control',
					                                 'required'  => 'required',
					                                 'placeholder'      => 'Eg. ABC',
					                                 'data-parsley-required-message' => 'First name is required',
					                                 'data-parsley-trigger'          => 'change',
					                                 'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
					                                 'data-parsley-minlength'        => '2',
					                                 'data-parsley-maxlength'        => '32'
					                            ])!!}

                               @else
															 {!! Form::text('name',old("name"),[
																					'class'     => 'form-control',
																					'required'  => 'required',
																					'id' => 'name',
																					'placeholder'      => 'Eg. ABC',
																					'data-parsley-required-message' => 'First name is required',
																					'data-parsley-trigger'          => 'change',
																					'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
																					'data-parsley-minlength'        => '2',
																					'data-parsley-maxlength'        => '32'
					                  						 ])!!}

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
														 {!! Form::text('lastname',old("lastname"),[
																				'class'     => 'form-control',
																				'id' => 'lastname',
																				'required'  => 'required',
																				'placeholder'      => 'Eg. XYZ',
																				'data-parsley-required-message' => 'last name is required',
																				'data-parsley-trigger'          => 'change',
																				'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
																				'data-parsley-minlength'        => '2',
																				'data-parsley-maxlength'        => '32'
																			 ])!!}

														 @else
														 {!! Form::text('lastname',old("lastname"),[
																				'class'     => 'form-control',
																				'id' => 'lastname',
																				'required'  => 'required',
																				'placeholder'      => 'Eg. XYZ',
																				'data-parsley-required-message' => 'last name is required',
																				'data-parsley-trigger'          => 'change',
																				'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
																				'data-parsley-minlength'        => '2',
																				'data-parsley-maxlength'        => '32'
																			 ])!!}
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
																	 {!! Form::email('email',old("email"),[
																						 'class'     => 'form-control',
																						 'id' => 'email',
																						 'required'  => 'required',
																						 'placeholder'      => 'Eg. example@mail.com',
																						 'data-parsley-required-message' => 'Email id is required',
																						 'data-parsley-trigger'          => 'change',
																						 'data-parsley-tyre'          => 'email',
																						 'data-parsley-minlength'        => '2',
																						 'data-parsley-maxlength'        => '32'
																						])!!}
                                   <input id="email" type="email" class="form-control" name="email" value="{{$email}}" required placeholder='Email id' data-parsley-required-message ='E-Mail  is required'  data-parsley-trigger='change'
																	 data-parsley-type= 'email'
																	 data-parsley-minlength ='2'
																		data-parsley-maxlength='32'>
                                   @else
																	 {!! Form::email('email',old("email"),[
																						 'class'     => 'form-control',
																						 'id' => 'email',
																						 'required'  => 'required',
																						 'placeholder'      => 'Eg. example@mail.com',
																						 'data-parsley-required-message' => 'Email id is required',
																						 'data-parsley-trigger'          => 'change',
																						 'data-parsley-tyre'          => 'email',
																						 'data-parsley-minlength'        => '2',
																						 'data-parsley-maxlength'        => '32'
																						])!!}
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
															{!! Form::password('password', [
														    	'id'=>'password',
										            	'class'    => 'form-control',
											            'required'  => 'required',
										            	'placeholder' => 'Password',
                                  'data-parsley-required-message' => 'Password is required',
                                  'data-parsley-trigger'          => 'change focusout',
										             	'data-parsley-uppercase'=>'1',
                                  'data-parsley-lowercase'=>'1',
										         	 	 'data-parsley-number'=>'1',
										          	 'data-parsley-special'=>'1'

											]) !!}

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
															{!! Form::password('password_confirmation',  [
				                       'class'   => 'form-control',
				                       'required' => 'required',
				                      'placeholder'  => 'Confirm Password',
				                      'data-parsley-required-message' => 'Password is required',
				                      'data-parsley-trigger'  => 'change focusout',
			                        'data-parsley-equalto'=>'#password',
			                        'data-parsley-uppercase'=>'1',
			                        'data-parsley-lowercase'=>'1',
			                        'data-parsley-number'=>'1',
			                        'data-parsley-special'=>'1'
                                 ]) !!}

                            </div>
                        </div>
												{{ Form::button('Signup', ['class' => 'btn  btn-success', 'type' => 'submit']) }}
						{!! Form::close()!!}
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
