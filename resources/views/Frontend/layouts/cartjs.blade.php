<script>

$(document).ready(function(){

  $('.coupon_code').click(function(e){
   if ( $(this).is(':checked') ) {
      $('#couponcode').val($(this).val());
       var coupon = $("#coupon").val();
   }
   else{ $('#text').val(""); }
  });




$('#clear').on('change', function(){
		var apply = document.getElementById("clear");
    apply.style.display = "none";
 });





  $('ul.user_address li').click(function(e){
       var id = $(this).attr("data-id");
         $.ajax({
         type:'get',
          dataType:'html',
          url:'/address/'+id,
           success:function(responce){
            console.log(responce);
             $("#addressData").html(responce);
           }
        });

       });

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

$('#Paypal').on('change',function(){

   if($(this).is(':checked')){
     $("#paybtn").css({display:'block',margin:'39px'});
     $("#codbtn").css("display",'none');
   }else{
  $("#paybtn").css("display",'none');
   }


});


$('#cod').on('change',function(){

   if($(this).is(':checked')){
     $("#codbtn").css({display:'block',margin:'39px'});
     $("#paybtn").css("display",'none');
   }else{
  $("#codbtn").css("display",'none');
   }



});

    var url = window.location.href;
    var couponurl = 'http://127.0.0.1:8000/coupon';
   if(url==couponurl){
    $("#clear").css("display","block");
    $("#apply").css("display","none");

   }



});


</script>
