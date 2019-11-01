@extends('master')

@section('content')
    <div class="content-wrapper ">
        <section class="content-header">
            <h2>Users Management</h2>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
        </section>

        <section class="content">

            {!! Form::open(array('route' => 'users.store','method'=>'POST','data-parsley-validate')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>FirstName:</strong>
                        {!! Form::text('name', null, [
	              'class'                         => 'form-control',
	              'required'                      => 'required',
	              'placeholder'                   => 'First Name',
	              'data-parsley-required-message' => 'First name is required',
	              'data-parsley-trigger'          => 'change',
	              'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
	              'data-parsley-minlength'        => '2',
	              'data-parsley-maxlength'        => '32'

	              ]) !!}
                        <span style="color: red">{{ $errors->first('name') }}</span>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>LastName:</strong>
                        {!! Form::text('lastname', null, [
	              'class'                         => 'form-control',
	              'required'                      => 'required',
	              'placeholder'                   => 'Last Name',
	              'data-parsley-required-message' => 'Last name is required',
	              'data-parsley-trigger'          => 'change',
	              'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
	              'data-parsley-minlength'        => '2',
	              'data-parsley-maxlength'        => '32'

	              ]) !!}
                        <span style="color: red">{{ $errors->first('lastname') }}</span>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, [
	              'class'                         => 'form-control',
	              'required'                      => 'required',
	              'placeholder'                   => 'Email Id',
	              'data-parsley-required-message' => 'Email is required',
	              'data-parsley-trigger'          => 'change',
	              'data-parsley-type'          => 'email',
	              'data-parsley-minlength'        => '2',
	              'data-parsley-maxlength'        => '32'

	              ]) !!}
                        <span style="color: red">{{ $errors->first('email') }}</span>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', [
                        'id'=>'password',
	              'class'                         => 'form-control',
	              'required'                      => 'required',
	              'placeholder'                   => 'Password',
	              'data-parsley-required-message' => 'Password is required',
	              'data-parsley-trigger'          => 'change focusout',
                'data-parsley-uppercase'=>'1',
                 'data-parsley-lowercase'=>'1',
                   'data-parsley-number'=>'1',
                 'data-parsley-special'=>'1'

	              ]) !!}
                        <span style="color: red">{{ $errors->first('password') }}</span>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password',  [
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
                        <span style="color: red">{{ $errors->first('confirm-password') }}</span>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                             {!! Form::Label('Roles', 'Roles:') !!}
                         {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                         <span style="color: red">{{ $errors->first('roles') }}</span>

                     </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong><br>
                        {!! Form::radio('status', '1',true) !!} Active
                        {!! Form::radio('status','0', false) !!} Inactive
                        <span style="color: red">{{ $errors->first('status') }}</span>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  {{ Form::button('Submit', ['class' => 'btn  btn-primary', 'type' => 'submit']) }}

                </div>
            </div>
            {!! Form::close() !!}

        </section>






</div>
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
