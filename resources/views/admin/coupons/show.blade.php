@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Coupons</h2>
    </section>
     <section class="content">
        <div class="row">
            <div class="col-xs-12 margin-tb">
       
              <div class="pull-right">
                   
                        <a href="{{ url('/admin/coupons') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                </div>
             </div>
          </div>


                     

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Title</th><td>{{ $coupon->title }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $coupon->code }} </td></tr>
                                    <th> Type </th><td> {{ $coupon->type }} </td></tr>
                                    <tr><th> Discount </th><td> {{ $coupon->discount }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
