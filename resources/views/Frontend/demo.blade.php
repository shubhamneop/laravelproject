@foreach($productss as  $product)
<div class="tab-pane fade active in"  >
  <div class="col-sm-3">
    <div class="product-image-wrapper">
      <div class="single-products">
        <div class="productinfo text-center">
          @foreach($product->image as $image)
          @endforeach
          <img src="{{asset($image->url)}}" alt="{{strtoupper($product->name)}}" width="208px" height="183px"/>
           <h2><i class="fa fa-inr"></i>  {{ $product->price }}</h2>
           <p>{{ strtoupper($product->name) }}</p>
           @if($product->attribute->quantity<=0)
               <a href="{{url('add-to-cart/'.$product->id)}}" class=" btn btn-default" disabled><i class="fa fa-close"></i>
            Out of Stock</a>
           @else
           @if(in_array($product->id,$cartvalue))
              <a href="{{url('add-to-cart/'.$product->id)}}" class="btn btn-fefault add-to-cart" disabled><i class="fa  fa-check-square-o"></i>
              Already in cart</a>
            @else
             <a href="{{url('add-to-cart/'.$product->id)}}" class="btn btn-default"><i class="fa fa-shopping-cart"></i>
               Add to cart</a>
           @endif
          @endif
        </div>

      </div>
    </div>
  </div>
</div>
@endforeach
