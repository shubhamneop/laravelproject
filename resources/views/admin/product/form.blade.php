
<div class="row">
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($product->name) ? $product->name : ''}}" data-parsley-required data-parsley-trigger="keyup" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ isset($product->description) ? $product->description : ''}}" data-parsley-required data-parsley-trigger="keyup">
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ isset($product->price) ? $product->price : ''}}" data-parsley-required data-parsley-type="number"data-parsley-trigger="keyup">
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
</div>

@if($formMode=='edit')
   @foreach($product->image as $image)
   <div class="col-xs-2 col-sm-2 col-md-2 form-group" >

    <img src="{{asset($image->url)}}"  style="width:50px;height:70px;">
  </div>
  @endforeach

  <div class="col-xs-12 col-sm-12 col-md-12">
 <div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}} increment">
     <label for="image_path" class="control-label">{{ 'Image Path' }}</label>
     <input class="form-control" multiple="multiple" name="image_path[]" type="file" id="image_path" value="{{ isset($image->image_path) ? $image->image_path : ''}}" data-parsley-required>
     {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}

 </div>
 </div>

@else
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}} increment">
    <label for="image_path" class="control-label">{{ 'Image Path' }}</label>
    <input class="form-control" multiple="multiple" name="image_path[]" type="file" id="image_path" value="{{ isset($image->image_path) ? $image->image_path : ''}}" data-parsley-required>
    {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}

</div>
</div>
@endif


@if($formMode=='edit')

<div class="col-xs-12 col-sm-12 col-md-12">
   <div class="form-group">
      <label for="title">Select Category:</label>

        <select name="category" id="category" class="form-control" data-parsley-required >
            <option value="">--- Select Category ---</option>
           @foreach ($categories as $category)
           @if($category->p_id == 0)
           <option value="{{$category->id}}"@if($product->category[0]->parent->id == $category->id) selected="selected" @endif>
               {{$category->category_name}}
           </option>
           @endif
            @endforeach
        </select>
       <span class="text-danger">{{ $errors->first('category') }}</span>
  </div>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <label for="title">Select Subcategory:</label>
      <select name="subcategories" class="form-control" id="subcategory" data-parsley-required>
        <option value="{{$product->category[0]->id}}">{{$product->category[0]->category_name}}</option>
      </select>
         <span class="text-danger">{{ $errors->first('subcategories') }}</span>
  </div>
  </div>
  @else
<div class="col-xs-12 col-sm-12 col-md-12">
   <div class="form-group">
      <label for="title">Select Category:</label>

        <select name="category" id="category" class="form-control" data-parsley-required >
            <option value="">--- Select Category ---</option>
           @foreach ($categories as $category)

           <option value="{{$category->id}}">
               {{$category->category_name}}
           </option>

            @endforeach
        </select>
       <span class="text-danger">{{ $errors->first('category') }}</span>
  </div>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <label for="title">Select Subcategory:</label>
      <select name="subcategories" class="form-control" id="subcategory" data-parsley-required>
      </select>
         <span class="text-danger">{{ $errors->first('subcategories') }}</span>
  </div>
</div>
@endif

 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('colour') ? 'has-error' : ''}}">
    <label for="colour" class="control-label">{{ 'Colour' }}</label>
    <input class="form-control" name="colour" type="text" id="colour" value="{{ isset($product->attribute->color) ? $product->attribute->color : ''}}"data-parsley-required data-parsley-trigger="keyup" >
    {!! $errors->first('colour', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="control-label">{{ 'Quantity' }}</label>
    <input class="form-control" name="quantity" type="text" id="quantity" value="{{ isset($product->attribute->quantity) ?$product->attribute->quantity : ''}}" data-parsley-required data-parsley-type="number" data-parsley-trigger="keyup">
    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
</div>
</div>

@if($formMode=='edit')

<div class="col-xs-12 col-sm-12 col-md-12">
   <div class="form-group">
     <input type="radio" id="status" name="status" value="Active" {{ ($product->status=="1")? "checked" : "" }} >Active</label>

     <input type="radio"  id="status" name="status" value="Inactive"  {{ ($product->status=="0")? "checked" : "" }} >Inactive</label>


  </div>
  </div>
  @else
<div class="col-xs-12 col-sm-12 col-md-12">
   <div class="form-group">
     <input type="radio" id="status" name="status" value="Active" checked >Active</label>

     <input type="radio"  id="status" name="status" value="Inactive">Inactive</label>

  </div>
</div>
@endif

 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
</div>
