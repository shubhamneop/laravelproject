@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Add Prodcts </h3>
     </section>
     <section class="content">
           <div class="pull-right" id="productData">
          <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                   </div>



                        <form method="POST" action="{{ url('/admin/product') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                              <div class="row">
                            @include ('admin.product.form', ['formMode' => 'create'])
                               </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')

<script type="text/javascript">
   $(document).ready(function() {
        $('select[name="category"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/myform/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="subcategories"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategories"]').append('<option value="'+ value.id +'">'+ value.category_name +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="subcategories"]').empty();
            }
        });



     $(".btn-success").click(function(){
         var html = $(".clone").html();
         $(".increment").after(html);
     });

     $("body").on("click",".btn-danger",function(){
         $(this).parents(".control-group").remove();
     });


    });


</script>
@endsection
