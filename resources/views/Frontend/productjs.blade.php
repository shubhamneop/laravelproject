<script>
$(document).ready(function(){
  $('ul.product_subcategory li').click(function(e)
  		{
  	 var category_id =$(this).attr("data-id");
          $.ajax({
       type:'get',
       dataType:'html',
       url: '{{url('/productbysubcategory')}}',
       data : 'id=' + category_id,
        success:function(responce){

         $("#productData").html(responce);
        }

     });

  });
  

});


</script>
