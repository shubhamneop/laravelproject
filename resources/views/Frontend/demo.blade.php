@foreach($productss as $product)
<div class="tab-pane fade active in"  >
  <div class="col-sm-3">
    <div class="product-image-wrapper">
      <div class="single-products">
        <div class="productinfo text-center">
          @foreach($product->image as $image)
          @endforeach
          <img src="{{asset('product/' .$image->image_path)}}" alt="{{strtoupper($product->name)}}" width="208px" height="183px"/>         
           <h2><i class="fa fa-inr"></i>  {{ $product->price }}</h2>
           <p>{{ strtoupper($product->name) }}</p>

          <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
        </div>

      </div>
    </div>
  </div>
</div>
@endforeach
