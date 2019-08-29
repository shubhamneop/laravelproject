@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Add Prodcts </h3>
     </section> 
     <section class="content">



			<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

				{!! Form::label('Category:') !!}

     			{!! Form::select('p_id',$categories, old('p_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
				<span class="text-danger">{{ $errors->first('p_id') }}</span>

								</div>














     </section>
     


   </div>

@endsection