
                   @foreach($data as $value)
                   <div class="col-xs-6 clearfix">
                   <div class="form-one" style="width: 350%;">
                     {!!Form::open(array('url'=>'paypal','method'=>'post'))!!}
                                     {{ csrf_field() }}
                     {!!Form::label('Fullname')!!}
                     {!!Form::text('fullname',$value->fullname,['placeholder'=>'Eg. ABC XYZ','class'=>'address-form'])!!}
                     {!!Form::label('Address1')!!}

                     {!!Form::text('address1',$value->address1,['placeholder'=>'Eg. ABC street','class'=>'address-form'])!!}
                     {!!Form::label('Address 2')!!}

                     {!!Form::text('address2',$value->address2,['placeholder'=>'Eg.  xy path ','class'=>'address-form'])!!}
                     {!!Form::label('Zipcode')!!}

                     {!!Form::text('zipcode',$value->zipcode,['placeholder'=>'Eg. 432 564','class'=>'address-form'])!!}
                     {!!Form::label('Country')!!}

                     {!!Form::text('country',$value->country,['placeholder'=>'Eg. India','class'=>'address-form'])!!}
                     {!!Form::label('State')!!}

                     {!!Form::text('state',$value->state,['placeholder'=>'Eg. Maharashtra','class'=>'address-form'])!!}
                     {!!Form::label('PhoneNo')!!}

                     {!!Form::text('phoneno',$value->phoneno,['placeholder'=>'Eg. 123456 ','class'=>'address-form'])!!}
                     {!!Form::label('MobieNo')!!}

                     {!!Form::text('mobileno',$value->mobileno,['placeholder'=>'Eg. 9876543210','class'=>'address-form'])!!}


								{!!Form::close()!!}
							</div>
					</div>
                @endforeach
