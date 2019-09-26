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
                                        <th>Name</th><td>{{ ucfirst($contactus->name) }}</td>
                                    </tr>
                                    <tr><th> Contact No </th><td> {{$contactus->contactno}} </td></tr>
                                    <th> E-Mail </th><td> {{ $contactus->email }} </td></tr>
                                    <tr><th> Subject </th><td> {{ ucfirst($contactus->subject) }} </td></tr>
                                    <tr><th>Message</th><td> {{ucfirst($contactus->message)}}</td></tr>
                                      <tr><th>Note</th><td> {{ucfirst($contactus->note)}}</td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
