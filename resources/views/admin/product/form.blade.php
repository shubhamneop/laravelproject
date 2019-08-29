
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($product->name) ? $product->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ isset($product->description) ? $product->description : ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="price" type="text" id="description" value="{{ isset($product->price) ? $product->price : ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
</div>

@if($formMode=='edit')
   @foreach($product->image as $image)
   @endforeach
<div class="col-xs-12 col-sm-12 col-md-12 form-group">
  <img src="{{asset('/product/' .$image->image_path)}}"  style="width:50px;height:70px;">
</div>
@endif
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('image_path') ? 'has-error' : ''}} increment">
    <label for="image_path" class="control-label">{{ 'Image Path' }}</label>
    <input class="form-control" multiple="multiple" name="image_path[]" type="file" id="image_path" value="{{ isset($product->image_path) ? $product->image_path : ''}}" >
    <div class="input-group-btn">
           <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
     </div>
    {!! $errors->first('image_path', '<p class="help-block">:message</p>') !!}
    
</div>
</div>
   <div class="clone hide">
         <div class="control-group input-group" style="margin-top:10px">
           <input type="file" name="image_path[]" class="form-control">
           <div class="input-group-btn">
             <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
           </div>
         </div>
       </div>


@if($formMode=='edit')

<div class="col-xs-12 col-sm-12 col-md-12 form-group">
        <label for="image_path" class="control-label">{{ 'Old Category' }}</label>
     : {{$product->category->categories->category_name}}</div>
@endif


<div class="col-xs-12 col-sm-12 col-md-12">
       <div class="form-group">
                <label for="title">Select Category:</label>
                <select name="category" id="category" class="form-control" >
                    <option value="">--- Select State ---</option>
                   @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                   <span class="text-danger">{{ $errors->first('category') }}</span>
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="title">Select Subcategory:</label>
                <select name="subcategories" class="form-control" id="subcategory" >
                </select>
                   <span class="text-danger">{{ $errors->first('subcategories') }}</span>
            </div>
            </div>

</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('colour') ? 'has-error' : ''}}">
    <label for="colour" class="control-label">{{ 'Colour' }}</label>
    <input class="form-control" name="colour" type="text" id="colour" value="{{ isset($product->attribute->color) ? $product->attribute->color : ''}}" >
    {!! $errors->first('colour', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="control-label">{{ 'Quantity' }}</label>
    <input class="form-control" name="quantity" type="text" id="quantity" value="{{ isset($product->attribute->quantity) ?$product->attribute->quantity : ''}}" >
    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
</div>
</div>

 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
