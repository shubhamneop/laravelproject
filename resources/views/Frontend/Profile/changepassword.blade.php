@extends('Frontend.masterfrontend')

@section('content')
	<section style="margin-left: 25%;"><!--form-->

		<div class="content">
			<div class="row">
				<div class="col-xs-12 col-xs-12-offset-1">

				<div class="col-xs-12">

					<div class="signup-form"><!--sign up form-->
						@if($message = Session::get('error'))

								<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">×</button>
											<p>{{$message}}</p>
							 </div>
						@endif
						<h2>Change Password!</h2>
						{!! Form::open(array('url'=>'changepassword','method'=>'post','data-parsley-validate'))!!}
							 {{csrf_field()}}

                 <div class="form-group row">
                   <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                   <div class="col-md-6">
										 {!! Form::password('password_current', [
													'id'=>'password-old',
													'class'    => 'form-control',
													'required'  => 'required',
													'placeholder' => 'Password'
													]) !!}

                      @if ($errors->has('password_current'))
                           <span class="help-block">
                                  <strong>{{ $errors->first('password_current') }}</strong>
                              </span>
                        @endif

                   </div>
               </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

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
                                    <span class="alert alert-danger	">
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
															 'id'=> 'password-confirm',
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
												{{ Form::button('Change<span class="fa-passwd-reset fa-stack">  <i class="fa fa-undo fa-stack-2x"></i>
					             <i class="fa fa-lock fa-stack-1x"></i></span>',['class'=>'btn btn-default','type'=>'submit'])}}
						{!!Form::close()!!}
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
