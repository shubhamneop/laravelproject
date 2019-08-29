              
                   @foreach($data as $value)
                   <div class="col-xs-6 clearfix">
                   <div class="form-one" style="width: 350%;">
								<form action="{{url('paypal')}}" method="post">
                                     {{ csrf_field() }}
									<input type="text" name="fullname" placeholder="Full Name *"value="{{$value->fullname}}" style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">								
									<input type="text" name="address1" placeholder="Address 1 *" value="{{$value->address1}}"style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
									<input type="text"  name="address2"  placeholder="Address 2"value="{{$value->address2}}" style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
								
							
							
							
									<input type="text" name="zipcode" placeholder="Zip / Postal Code *"value="{{$value->zipcode}}"style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
									<input type="text" name="country" placeholder=" Country*"value="{{$value->country}}"style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
									<input type="text" name="state" placeholder=" State / Province / Region*" value="{{$value->state}}"style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
								
									<input type="text" name="phoneno" placeholder="Alternate NO *"value="{{$value->phoneno}}" style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
									<input type="text" name="mobileno" placeholder="Mobile Phone"value="{{$value->mobileno}}" style=" background: #F0F0E9;border: 0;color: #696763; padding: 5px;margin:10px; width: 100%;height: 40px; border-radius: 0; resize: no;">
									

									
								</form>
							</div>
					</div>		          
                @endforeach
