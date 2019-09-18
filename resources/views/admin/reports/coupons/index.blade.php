@extends('master')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h2>Coupons Report</h2>
  </section>
  <section class="content">
    <div class="row" style="float:right;">
    <div class="pull-right col-xs-12">
       <form method="GET" action="{{ url('/admin/reports/coupon') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
            <div class="">
               <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
               <span class="">
                   <button class="btn btn-info" type="submit">
                       <i class="fa fa-search"></i>
                   </button>
               </span>
           </div>
       </form>
   </div>
</div>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Discount</th>
            <th>Type</th>
            <th>User name</th>
           <th> Order Details</th>

        </tr>
        @foreach ($coupons as $coupon)
            <tr>
                <td>{{ $loop->iteration }}</td>
                 <td>{{$coupon->coupon->code}}</td>
                  <td>{{$coupon->coupon->discount}}</td>
                  <td>{{$coupon->coupon->type}}</td>
                  <td>{{$coupon->user->name}} {{$coupon->user->lastname}}</td>
                <td>
                     <a href="{{ url('/admin/order/' .$coupon->order_detail['id']) }}" title="View report" target="_blank">{{$coupon->order_detail['order_no']}}</a>


                </td>
            </tr>
        @endforeach
    </table>
  <div class="pagination-wrapper"> {!! $coupons->appends(['search' => Request::get('search')])->render() !!} </div>
  </section>
</div>
@endsection
