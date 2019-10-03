@extends('Frontend.masterfrontend')

@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						  @if($message = Session::get('message'))

                                     <div class="alert alert-danger">
                                     <button type="button" class="close" data-dismiss="alert">×</button>
                                      <p>{{$message}}</p>
                                       </div>
                                      @endif
						<h2>Login to your account</h2>
						{!! Form::open(array('url'=>'userlogin','method'=>'post')) !!}

							 {{csrf_field()}}

							   <div class="form-group row">
                               <label for="name" class="col-md-4 control-label">Login With</label>
                               <div class="col-md-6">
                                <!--   <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                                   <a href="{{ url('login/twitter') }}" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                                   <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                                    <a href="{{ url('login/bitbucket') }}" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-bitbucket"></i></a>
                                   <a href="{{ url('login/linkedin') }}" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a> -->
                                   <a href="{{ url('login/github') }}" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>

                                   <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>


                               </div>
                           </div>
                 {!! Form::email('email',null,array('placeholder'=>'Eg.example@mail.com'))!!}
							   <span style="color: red">{{ $errors->first('email') }}</span>

					  		{!! Form::password('password',array('placeholder'=>'Password')) !!}
							   <span style="color: red">{{ $errors->first('password') }}</span>

								 {{ Form::button('Login', ['class' => 'btn  btn-success', 'type' => 'submit']) }}

             {!! Form::close() !!}
						<a href="{{url('register')}}">New User Register Here !</a> Or
						<a href="{{url('forgetpassword')}}">Forget Password</a>
					</div><!--/login form-->
				</div>


			</div>
		</div>
	</section><!--/form-->


@endsection
