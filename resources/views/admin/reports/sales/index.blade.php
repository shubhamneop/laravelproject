@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Sales Report</h2>

    </section>
     <section class="content">
       @if(app('request')->input('search'))
           <a href="{{ url('sales/xls',app('request')->input('search')) }}"><button class="btn btn-sm btn-success">Excel Report</button></a>
           <a href="{{ url('sales/csv',app('request')->input('search')) }}"><button class="btn btn-sm btn-info">CSV Report</button></a>

     @else
       <a href="{{url('sales/xls')}}" class="btn btn-sm btn-success">Excel Report</a>
       <a href="{{url('sales/csv')}}" class="btn btn-sm btn-info">CSV Report</a>
    @endif
       <div class="row" style="float:right;">
         <div class="pull-right col-xs-12" >
            <form method="GET" action="{{ url('/admin/reports/sales') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                 <div style="margin-bottom: 20px;">
                    <select name="category_id" class="select-control">
                      <option value="" >select category</option>
                        @foreach($subcategory as $category)
                        <option value="{{ isset($category->id) ? $category->id :request('category_id')}}">{{ucfirst($category->category_name)}}</option>
                       @endforeach
                     </select>
                   <label> From date</label>
                    <input type="date" class="form-control" name="fromdate" placeholder="Search..." value="{{ request('fromdate') }}">
                   <label>To date</label>
                    <input type="date" class="form-control" name="todate" placeholder="Search..." value="{{ request('todate') }}">
                     <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                    <span class="">
                        <button class="btn btn-info" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>


                </div>
            </form>
        </div>
      <br>
  </div>
        <table  class="table table-bordered table-hover" role="grid">
          <thead>
         <tr>
            <th>#</th>
             <th>Item image</th>
             <th>ProductName</th>
             <th>Price</th>
             <th>Quantity</th>
             <th>Category</th>

         </tr>
       </thead>
       <tbody>
         @foreach($sales as $item)
             <tr>
                 <td>{{$loop->iteration}}</td>
                   <td>  <img src="{{('http://laraveldemoimageupload.s3.ap-south-1.amazonaws.com/product/' .$item->product_image)}}" alt="product image" width="60px" height="60px" /></td>
                 <td>{{$item->product_name}}</td>
                 <td>{{$item->price}}</td>
                 <td>{{$item->quantity}}</td>
                 <td>{{$item->categoryname->category_name}}</td>
             </tr>

      @endforeach
      </tbody>

       </table>

       <div class="pagination-wrapper"> {!! $sales->appends($_GET)->render() !!} </div>





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
