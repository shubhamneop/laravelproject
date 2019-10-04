<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontend/js/price-range.js')}}"></script>
  <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
  <script src="{{asset('frontend/js/main.js')}}"></script>

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

      var url = window.location.pathname;
      var couponurl = '/coupon';
     if(url==couponurl){
      $("#clear").css("display","block");
      $("#apply").css("display","none");

     }

     window.Parsley.addValidator('uppercase', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var uppercases = value.match(/[A-Z]/g) || [];
        return uppercases.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) uppercase letter.'
      }
      });

    //has lowercase
      window.Parsley.addValidator('lowercase', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var lowecases = value.match(/[a-z]/g) || [];
        return lowecases.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) lowercase letter.'
      }
      });

    //has number
      window.Parsley.addValidator('number', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var numbers = value.match(/[0-9]/g) || [];
        return numbers.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) number.'
      }
      });

    //has special char
     window.Parsley.addValidator('special', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var specials = value.match(/[^a-zA-Z0-9]/g) || [];
        return specials.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) special characters.'
      }
     });





  });


  </script>
