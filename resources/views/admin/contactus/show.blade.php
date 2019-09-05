@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Message</h2>
    </section>
     <section class="content">
        <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-right">

                        <a href="{{ url('/admin/contactus') }}" class="btn btn-info btn-sm" title="Add New product">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                </div>
             </div>
          </div>




                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Name</th><td>{{ $contact->name }}</td>
                                    </tr>
                                    <tr><th> Contact No </th><td> {{$contact->contactno}} </td></tr>
                                    <th> E-Mail </th><td> {{ $contact->email }} </td></tr>
                                    <tr><th> Subject </th><td> {{ $contact->subject }} </td></tr>
                                    <tr><th>Message</th><td> {{$contact->message}}</td></tr>
                                      <tr><th>Note</th><td> {{$contact->note}}</td></tr>  
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
