@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
      <h2>Change status</h2>

        <div class="pull-right">
            <a href="{{ url('/admin/order') }}" title="Back"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
             </div>
     </section>
     <section class="content">


                      {!!Form::open(array('url'=>['/admin/order',$order->id],'id'=>'order-form','method'=>'post','files' => true))!!}
                             {{method_field('PATCH')}}
                            {{ csrf_field() }}
                               <div class="row">

                                 <div class="table-responsive">
                                     <table class="table">
                                         <thead>
                                             <tr>
                                                <th>#</th><th>Product</th><th>Quantity</th><th>Price</th>
                                             </tr>
                                         </thead>
                                             @foreach($orders->items as $item)
                                             <tr>
                                                 <td><img src="{{asset('product/' .$item['image'])}}" alt="" width="60px" height="60px" /></td>
                                                 <td> {{$item['item']['name']}}</td>
                                                 <td> {{$item['qty']}}</td>
                                                 <td>{{$item['price']}}</td>
                                             </tr>
                                            @endforeach

                                        </table>

                                 <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                 <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                                     <label for="type" class="control-label">{{ 'Status' }}</label>
                                        {!! Form::select('status',$enumoption,$status,['class' => 'form-control']) !!}


                                     {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                 </div>
                                 {!! Form::button('Submit',['class'=>'btn btn-primary','type'=>'submit'])!!}
                                 </div>
                               </div>
                        {!!Form::close()!!}


        </section>
      </div>
@endsection
