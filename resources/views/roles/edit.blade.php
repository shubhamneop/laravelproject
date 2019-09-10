@extends('master')

@section('content')
    @can('role-edit')
<div class="content-wrapper">
    <section class="content-header">
        <h2>Edit Role #{{$role->name}} </h2>
    </section>

    <section class="content">
         @if(count($errors)>0)
                <div class="alert-danger">
                     <ul>
                   @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                      </ul>
                  @endforeach
                  </div>
          @endif
          <div class="row">
            <div class="col-lg-12 margin-tb">

              <div class="pull-right">
               <a class="btn btn-primary" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                 </div>
             </div>
          </div>
     {!! Form::model($role,['method'=>'PATCH','route'=>['roles.update', $role->id],'id'=>'role-form']) !!}
         <div class="row">
             <div class="col-xs-12 col-sm-12">
                 <div class="form-group">
                     <strong>Name</strong>
                     {!! Form::text('name',null,
                     	                ['class'     => 'form-control',
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
             <div class="col-sm-12 col-xs-12">
                 <strong>Permission :</strong>
                 <br/>
                 @foreach($permission as $value)
                     <label>{!!  Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name'))  !!}
                         {{ $value->name }}</label>
                     <br/>
                 @endforeach
             </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
             <button type="submit" class="btn btn-success">Submit</button>
         </div>
         </div>


     {!! Form::close() !!}




    </section>
@endcan


</div>

@endsection
@section('script')
<script>
$(document).ready(function(){
  $('#role-form').parsley();
});
</script>
@endsection
