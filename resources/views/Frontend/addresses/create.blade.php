@extends('Frontend.masterfrontend')

@section('content')

                <div class="card">
                    <div class="pull-right">
                        <a href="{{ url('/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>

                        <div class="form-two">
                          <form method="POST" action="{{ url('/addresses') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                             {{ csrf_field() }}

                             @include ('Frontend.addresses.form', ['formMode' => 'create'])

                          </form>
                       </div>

                </div>
            </div>
        </div>
    </div>
@endsection
