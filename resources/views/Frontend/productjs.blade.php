<script>
$(document).ready(function(){
@foreach(App\cat::all() as $clist)
  $("#{{$clist->id}}").click(function(){
          var cat = {{$clist->id}} ;
     $.ajax({
       type:'get',
       dataType:'html',
       url: '{{url('/productCat')}}',
       data : 'id=' + cat,
        success:function(responce){

         $("#productData").html(responce);
        }

     });

  });
@endforeach
});


</script>
