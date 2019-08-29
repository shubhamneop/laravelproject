@extends('master')
@section('content')
 <div class="content-wrapper">
   <section class="content-header">
   	<h2>Create category</h2>
   </section>
    <section class="content">
    	 <div class="row">
            <div class="col-xs-12 margin-tb">
       
              <div class="pull-right">
              <a href="{{ url('/admin/categories') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden=""></i> Back</button></a>
                 </div>
             </div>
          </div>
            
  
                       <form method="POST" action="{{ url('/admin/categories') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                          
                            {{ csrf_field() }}

				  				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

									{!! Form::label('Title:') !!}

									{!! Form::text('category_name', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}

									<span class="text-danger">{{ $errors->first('category_name') }}</span>

								</div>


								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

									{!! Form::label('Category:') !!}

									{!! Form::select('p_id',$allCategories, old('p_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}

									<span class="text-danger">{{ $errors->first('p_id') }}</span>

								</div>


								<div class="form-group">

									 <input class="btn btn-success" type="submit" value="Create" name="Create">

								</div>


				  			</form>
    </section>

  
 </div>
@endsection