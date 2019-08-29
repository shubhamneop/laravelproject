@extends('Frontend.masterfrontend')

@section('content')

                <div class="card">
                    <div class="card-header">Create New Address</div>
                    <div class="pull-right">
                        <a href="{{ url('/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                      

                        <form method="POST" action="{{ url('/addresses') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('Frontend.addresses.form', ['formMode' => 'create'])

                        </form>

                  
                </div>
            </div>
        </div>
    </div>
@endsection
