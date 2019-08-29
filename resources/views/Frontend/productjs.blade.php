<script>
$(document).ready(function(){

  // alert('HI');
  
@foreach(App\cat::all() as $clist)
  $("#cat{{$clist->id}}").click(function(){
    var cat = $("#cat{{$clist->id}}").val();
     // alert(cat);
     
     $.ajax({
       type:'get',
       dataType:'html',
       url: '{{url('/productCat')}}',
       data : 'id=' + cat,
        success:function(responce){
         console.log(responce);
         $("#productData").html(responce);
        }

     });






  });
  @endforeach
  
});


</script>




