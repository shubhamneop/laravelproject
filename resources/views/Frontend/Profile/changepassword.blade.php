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
						<form action="{{url('changepassword')}}" method="post">
							 {{csrf_field()}}

                 <div class="form-group row">
                   <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                   <div class="col-md-6">
                       <input id="password-old" type="password" class="form-control @error('password') is-invalid @enderror" name="password_current" required autocomplete="new-password">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
							<button type="submit" class="btn btn-default">Change<span class="fa-passwd-reset fa-stack">  <i class="fa fa-undo fa-stack-2x"></i>
             <i class="fa fa-lock fa-stack-1x"></i></span></button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
