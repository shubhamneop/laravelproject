@extends('master')

@section('content')
<div class="content-wrapper" style="min-height: 926px">

     <section class="content-header">
          <h1>
            Dashboard

          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{$ordercount}}</h3>

                  <p>Order Placed</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('admin/order')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->


            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{$usercount}}</h3>

                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('admin/users')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue-active">
                <div class="inner">
                  <h3>{{$msgcount}}</h3>

                  <p>Message</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-chatbubble-outline"style="color: cyan;"></i>
                </div>
              <a href="{{url('admin/contactus')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- ./col -->
          </div>
          <div class="col-md-6">
           <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Order Chart</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
               {!! $chart->html() !!}
                </div>
              </div>

              <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
         <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Category Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                 {!! $donut->html() !!}
              </div>

            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>










  </section>
</div>

{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $donut->script() !!}
@endsection
