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




                       {!!Form::open(array('url'=>['/admin/categories',$category->id],'method'=>'post','enctype'=>'multipart/form-data','id'=>'category-form'))!!}
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}


									<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
                                    {!! Form::label('Name:') !!}
                                    {!!Form::text('category_name',$category->category_name,['class'=>'form-control',
                                    'data-parsley-required-message'=>'Category name is required',
                                    'data-parsley-trigger'=>'change',
                                    'data-parsley-pattern'=>'/^[a-zA-Z]*$/'
                                    ])!!}
                                    

   								<span class="text-danger">{{ $errors->first('category_name') }}</span>

								</div>


								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

									{!! Form::label('Category:') !!}
                  <select class="form-control" name="p_id" data-parsley-required>
                       <option value="">select category</option>
                     @foreach($allCategories as $option)
                         @if($category->p_id==0)
                          <option value="{{$option->id}}">{{$option->category_name}}</option>
                          @else
                         <option value="{{$option->id}}"@if($category->parent->id==$option->id) selected="selected" @endif >{{$option->category_name}}</option>
                          @endif
                     @endforeach

                  </select>

									<span class="text-danger">{{ $errors->first('p_id') }}</span>

								</div>


								<div class="form-group">

									 <input class="btn btn-success" type="submit" value="Create" name="Create">

								</div>


				  			{!!Form::close()!!}
    </section>


 </div>
@endsection
@section('script')
 <script>
  $(document).ready(function(){
    $('#category-form').parsley();
  });
 </script>

@endsection
