@extends('master')

@section('content')
    <div class="content-wrapper">
         <section class="content-header">
           <h2>Edit EmailTemplate #{{ $emailtemplate->id }}</h2>
         </section>
       <section class="content">
            <div class="row">
                <div class="col-xs-12 margin-tb">
                   <div class="pull-right">
                     <a href="{{ url('/admin/email-templates') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                </div>
            </div>



                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $emailtemplate->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $emailtemplate->name }} </td></tr><tr><th> Subject </th><td> {{ $emailtemplate->subject }} </td></tr><tr><th> Message </th><td> {!! $emailtemplate->message !!} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
