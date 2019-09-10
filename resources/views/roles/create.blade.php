@extends('master')

@section('content')
    <div class="content-wrapper "style="min-height: 100%">
        <section class="content-header">
            <h2>Role Management</h2>

        </section>

        <section class="content">

        <div class="row">
            <div class="col-lg-12 margin-tb">

              <div class="pull-right">
               <a class="btn btn-primary" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                 </div>
             </div>
          </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {!! Form::open(array('route' => 'roles.store','method'=>'POST','id'=>'role-form')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, [

	                'class'     => 'form-control',
	              'required'    => 'required',
	              'placeholder'     => 'Role Name',
	              'data-parsley-required-message' => 'Role name is required',
	              'data-parsley-trigger'          => 'change focusout',
	              'data-parsley-pattern'          => '/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i',
	              'data-parsley-minlength'        => '2',
	              'data-parsley-maxlength'        => '32',
	              ]) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name', 'data-parsley-multiple','required'=>'required')) }}
                                {{ $value->name }}</label>
                            <br/>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </section>






</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
  $('#role-form').parsley();
});
</script>
@endsection
