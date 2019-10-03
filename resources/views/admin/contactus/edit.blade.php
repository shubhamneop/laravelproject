@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Respon Message #{{ $contactus->id }} </h3>
     </section>
     <section class="content">

                        <div class="pull-right">

                        <a href="{{ url('/admin/contactus') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                      </div>


                       <br><br>
                       {!! Form::open(array('url'=>['/admin/contactus', $contactus->id],'method'=>'post'))!!}
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group col-md-6">
                               <label class="form-control" >{{$contactus->name}}</label>

                           </div>
                           <div class="form-group col-md-6">
                             <label class="form-control" >{{$contactus->contactno}}</label>
                          </div>
                           <div class="form-group col-md-12">
                             <label class="form-control" >{{$contactus->email}}</label>

                           </div>

                           <div class="form-group col-md-12">
                             <label class="form-control" >{{$contactus->subject}}</label>
                           </div>
                           <div class="form-group col-md-12">
                             <label class="form-control" >{{$contactus->message }}</label>
                           </div>
                           <div class="form-group col-md-12">
                             <label>Add note</label>
                             {!! Form::textarea('note', null, ['id' => 'note', 'rows' => 4, 'cols' => 54,'class'=>'form-control' ]) !!}
                                 <span style="color: red">{{ $errors->first('note') }}</span>
                           </div>
                           <div class="form-group col-md-12">
                               <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                           </div>
                        {!!Form::close()!!}



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
