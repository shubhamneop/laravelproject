


@extends('Frontend.masterfrontend')

@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-xs-8 ">
                    <div class="login-form" style="margin-left: 45%;margin-right: -20%;"><!--login form-->
                        <h2>{{ __('Reset Password') }}</h2>
                        
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                          <button type="button" class="close" data-dismiss="alert">×</button>   

                            {{ session('status') }}

                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                            <label for="email" class="col-xs-8 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-xs-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="alert alert-danger" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        

                           <div class="col-xs-8 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                     
                    </form>
                      
                    </div><!--/login form-->
                </div>
                

            </div>
        </div>
    </section><!--/form-->
    
    
@endsection



