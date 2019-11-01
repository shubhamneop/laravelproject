@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Customer Report</h2>
    </section>
     <section class="content">
       <div class="row" style="float:right;">
       <div class="pull-right col-xs-12">
          <form method="GET" action="{{ url('/admin/reports/customer') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
               <div style="margin-bottom: 20px;">

                 <label> From date</label>
                  <input type="date" class="form-control" name="fromdate" placeholder="Search..." value="{{ request('fromdate') }}">
                 <label>To date</label>
                  <input type="date" class="form-control" name="todate" placeholder="Search..." value="{{ request('todate') }}">
                  <input type="text" class="form-control" name="search" placeholder="Search..." value="{{request('search')}}">
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
  @if(app('request')->input('search'))
  		<a href="{{ url('customer/xls',app('request')->input('search')) }}"><button class="btn btn-sm btn-success">Excel Report</button></a>
      <a href="{{ url('customer/csv',app('request')->input('search')) }}"><button class="btn btn-sm btn-info">CSV Report</button></a>

@else
  <a href="{{url('customer/xls')}}" class="btn btn-sm btn-success">Excel Report</a>
  <a href="{{url('customer/csv')}}" class="btn btn-sm btn-info">CSV Report</a>
@endif

       <table class="table table-bordered">
           <tr>
               <th>#</th>
               <th>Name</th>
               <th>Email</th>
               <th>Registered At</th>

               <th width="280px">Action</th>
           </tr>
           @foreach ($users as $key => $user)
               <tr>
                   <td>{{ $loop->iteration }}</td>
                   <td>{{ $user->name }} {{$user->lastname}}</td>
                   <td>{{ $user->email }}</td>
                   <td>{{$user->created_at}}</td>

                   <td>

                         @can('order-list')
                         <a href="{{ url('/admin/order?search=' . $user->email) }}" title="View report" target="_blank"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>View Orders</button></a>
                         @endcan

                         @can('display')
                         <a href="{{ url('/admin/reports/customer/' . $user->id . '/edit') }}" title="Edit report"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                         <form method="POST" action="{{ url('/admin/reports' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                             {{ method_field('DELETE') }}
                             {{ csrf_field() }}
                             <button type="submit" class="btn btn-danger btn-sm" title="Delete report" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                         </form>
                         @endcan

                   </td>

               </tr>
           @endforeach
       </table>
       <div class="pagination-wrapper"> {!! $users->appends($_GET)->render() !!} </div>





     </section>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(".form_datetime").datetimepicker();
</script>
@endsection
