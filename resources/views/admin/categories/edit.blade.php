@extends('master')
@section('content')
 <div class="content-wrapper">
   <section class="content-header">
   	<h2>Edit category</h2>
   </section>
    <section class="content">
    	 <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-right">
              <a href="{{ url('/admin/categories') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden=""></i> Back</button></a>
                 </div>
             </div>
          </div>




                       {!!Form::open(array('url'=>['/admin/categories',$category->id],'method'=>'post','data-parsley-validate','enctype'=>'multipart/form-data','id'=>'category-form'))!!}
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}


									<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
                                    {!! Form::label('Name:') !!}
                                    {!!Form::text('category_name',$category->category_name,['class'=>'form-control',
                                    'data-parsley-required-message'=>'Category name is required',
                                    'required'=>'required',
                                    'data-parsley-trigger'=>'change',
                                    'data-parsley-pattern'=>'/^[a-zA-Z]*$/'
                                    ])!!}


   								<span class="text-danger">{{ $errors->first('category_name') }}</span>

								</div>


								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

									{!! Form::label('Category:') !!}
                    @if($category->p_id==0)
                    {!! Form::select('p_id',array_merge(['' => 'Please Select Category'],$allCategories),null,['class' => 'form-control'])!!}

                    @else
                    {!! Form::select('p_id',$allCategories,$category->parent->id,['class'=>'form-control'])!!}
                   @endif

									<span class="text-danger">{{ $errors->first('p_id') }}</span>

								</div>


								<div class="form-group">
                {!! Form::button('Update',['class'=>'btn btn-success','type'=>'submit'])!!}

								</div>


				  			{!!Form::close()!!}
    </section>


 </div>
@endsection
