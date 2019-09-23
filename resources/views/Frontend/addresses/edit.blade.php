@extends('Frontend.masterfrontend')

@section('content')
                <div class="card">

                    <div class="pull-right">
                        <a href="{{ url('/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                      </div>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                      <div class="login-form" style="width: 550px;position:relative;left:25%;right: 25%;">
                        <form method="POST" action="{{ url('/addresses/' . $address->id) }}" accept-charset="UTF-8"  enctype="multipart/form-data" data-parsley-validate>
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('Frontend.addresses.form', ['formMode' => 'edit'])

                        </form>
                      </div>

                </div>

@endsection
