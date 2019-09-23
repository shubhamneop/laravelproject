@extends('Frontend.masterfrontend')

@section('content')

                <div class="card">
                    <div class="pull-right">
                        <a href="{{ url('/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>

                        <div class="login-form" style="width: 550px;position:relative;left:25%;right: 25%;">

                          <form method="POST" action="{{ url('/addresses') }}" accept-charset="UTF-8"  enctype="multipart/form-data" data-parsley-validate>
                             {{ csrf_field() }}

                             @include ('Frontend.addresses.form', ['formMode' => 'create'])

                          </form>
                       </div>

                </div>
            </div>
        </div>
    </div>
@endsection
