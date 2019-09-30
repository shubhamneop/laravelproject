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



function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  var apply = document.getElementById("apply");
  if (checkBox.checked == true){
    text.style.display = "block";
    apply.style.display = "block";
  } else {
     text.style.display = "none";
     apply.style.display = "block";

  }
}



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



$('#Paypal').on('change',function(){
  var btn = document.getElementById("paybtn");
   var cbtn = document.getElementById("codbtn");
   if($(this).is(':checked')){

     btn.style.display ="block";
     btn.style.margin ="39px";
      cbtn.style.display="none";
   }else{
    btn.style.display="none";
   }


});


$('#cod').on('change',function(){
  var btn = document.getElementById("codbtn");
  var pbtn = document.getElementById("paybtn");
   if($(this).is(':checked')){

    btn.style.display ="block";
    btn.style.margin ="45px"
  pbtn.style.display="none";
   }else{
    btn.style.display="none";
   }


});

    var url = window.location.href;
    var couponurl = 'http://127.0.0.1:8000/coupon';
   if(url==couponurl){
     var clear = document.getElementById("clear");
     var apply = document.getElementById("apply");
     clear.style.display = "block";
     apply.style.display ="none";

   }



});


</script>
