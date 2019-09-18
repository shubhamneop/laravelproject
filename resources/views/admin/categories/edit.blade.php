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





                           <form id="category-form" method="POST" action="{{ url('/admin/categories/' . $categories->id) }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}


									<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
                                    <label for="value" class="control-label">{{ 'Name' }}</label>
                                    <input class="form-control" name="category_name" type="text" id="value" value="{{$categories->category_name}}"
                                    data-parsley-required-message = "Category name is required"
                                     data-parsley-trigger="change"
                                     data-parsley-pattern ="/^[a-zA-Z]*$/"   >

   								<span class="text-danger">{{ $errors->first('category_name') }}</span>

								</div>

                       @if($categories->parent)
                      <div class="form-group">
                        <label for="value" class="control-label">{{ 'Parent' }}</label>
                      :   {{$categories->parent->category_name}}

                      </div>
                      @endif

								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

									{!! Form::label('Category:') !!}
                  <select class="form-control" name="p_-id" data-parsley-required>

                     @foreach($allCategories as $option)

                       <option value="{{$option->id}}"@if($categories->parent->id==$option->id) selected="selected" @endif >{{$option->category_name}}</option>

                     @endforeach
                      
                  </select>

									<span class="text-danger">{{ $errors->first('p_id') }}</span>

								</div>


								<div class="form-group">

									 <input class="btn btn-success" type="submit" value="Create" name="Create">

								</div>


				  			</form>
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
