@extends('master')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h2>Reports</h2>
  </section>
  <section class="content">
    <a href="" class="btn btn-primary">Sales Reports</a>
    <a href="{{url('admin/reports/customer')}}" class="btn btn-primary">Customer Reports</a>
    <a href="{{url('admin/reports/coupon')}}" class="btn btn-primary">Cupons Reports</a>


  </section>
</div>

@endsection
