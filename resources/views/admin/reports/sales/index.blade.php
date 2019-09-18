@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Sales Report</h2>
        <div class="pull-right col-xs-12" style="position: relative;
    left: 510px;">
           <form method="GET" action="{{ url('/admin/reports/sales') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div style="margin-bottom: 20px;">

                  <label> From date</label>
                   <input type="date" class="form-control" name="fromdate" placeholder="Search..." value="{{ request('fromdate') }}">
                  <label>To date</label>
                   <input type="date" class="form-control" name="todate" placeholder="Search..." value="{{ request('todate') }}">
                   <span class="">
                       <button class="btn btn-info" type="submit">
                           <i class="fa fa-search"></i>
                       </button>
                   </span>


               </div>
           </form>
       </div>
    </section>
     <section class="content">
       <div class="row" style="float:right;">

      <br>
  </div>
        <table id="example2" class="table table-bordered table-hover" role="grid">
            <thead>
           <tr>
              <th>#</th>
               <th>Item image</th>
               <th>ProductName</th>
               <th>Price</th>
               <th>Customer Name</th>
               <th>Category</th>

           </tr>
         </thead>
         <tbody>
         @foreach($sales as $sale)
            @foreach($sale->cart->items as $item)
               <tr>
                   <td>{{$sale->id}}</td>
                     <td>  <img src="{{asset('product/' .$item['image'])}}" alt="" width="60px" height="60px" /></td>
                   <td>{{strtoupper($item['item']['name'])}}</td>
                   <td>{{$item['price']}}</td>
                   <td>{{strtoupper($sale->user->name)}}</td>
                   <td>{{strtoupper($item['item']['category']['categories']['category_name'])}}</td>
               </tr>
               @endforeach
        @endforeach
      </tbody>

       </table>






     </section>
    </div>
@endsection
@section('script')

<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example2').DataTable();
  });
</script>
  @endsection
