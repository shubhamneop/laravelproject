@extends('master')

@section('content')
 <div class="content-wrapper">
     <section class="content-header">
        <h2> Respon Message #{{ $contact->id }} </h3>
     </section>
     <section class="content">

                        <div class="pull-right">

                        <a href="{{ url('/admin/contactus') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                      </div>


                       <br><br>
                        <form id="demo-form" method="POST" action="{{ url('/admin/contactus/' . $contact->id) }}"  accept-charset="UTF-8" enctype="multipart/form-data" data-parsley-validate>
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group col-md-6">
                               <input type="text" name="name" class="form-control" required="required" value="{{$contact->name}}" placeholder="Name" data-parsley-required data-parsley-pattern="/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i">
                                 <span style="color: red">{{ $errors->first('name') }}</span>
                           </div>
                           <div class="form-group col-md-6">
                              <input type="text" name="contactno" class="form-control" required="required" value="{{$contact->contactno}}" placeholder="Contact No" data-parsley-required data-parsley-type="number" data-parsley-pattern="/^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/">
                                <span style="color: red">{{ $errors->first('contactno') }}</span>
                          </div>
                           <div class="form-group col-md-12">
                               <input type="email" name="email" class="form-control" required="required" value="{{$contact->email}}" placeholder="Email" data-parsley-required>
                                 <span style="color: red">{{ $errors->first('email') }}</span>
                           </div>

                           <div class="form-group col-md-12">
                               <input type="text" name="subject" class="form-control" required="required" value="{{$contact->subject}}" placeholder="Subject">
                                 <span style="color: red">{{ $errors->first('subject') }}</span>
                           </div>
                           <div class="form-group col-md-12">
                               <input name="message" id="message" required="required" class="form-control" value="{{$contact->message}}" rows="8" placeholder="Your Message Here">
                                 <span style="color: red">{{ $errors->first('message') }}</span>
                           </div>
                           <div class="form-group col-md-12">
                               <textarea name="note" id="note" required="required" class="form-control" value="{{$contact->note}}" rows="8" placeholder="Add Note Here"> </textarea>
                                 <span style="color: red">{{ $errors->first('note') }}</span>
                           </div>
                           <div class="form-group col-md-12">
                               <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                           </div>
                        </form>


<script type="text/javascript">
$(function () {
    $('#demo-form').parsley();
});
</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
