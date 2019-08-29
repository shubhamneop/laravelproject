@extends('Frontend.masterfrontend')

@section('content')
                <div class="card">
                    <div class="card-header">Address {{ $address->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>#</th><td>{{ $address->fullname }}</td>
                                    </tr>
                                    <tr><th> Address1 </th><td> {{ $address->address1 }} </td></tr><tr><th> Address2 </th><td> {{ $address->address2 }} </td></tr><tr><th> Zipcode </th><td> {{ $address->zipcode }} </td></tr>

                                    <tr><th>Country</th><td>{{$address->country}}</td></tr>

                                     <tr><th>State</th>   <td>{{$address->state}}</td></tr>
                                      <tr><th>Phone No </th><td>{{$address->phoneno}}</td></tr>

                                     <tr><th>Mobile No</th>   <td>{{$address->mobileno}}</td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
