 

@extends('Frontend.masterfrontend')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

                @if ($message = Session::get('success'))

                
                <div class="custom-alerts alert alert-success fade in">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>

                    {!! $message !!}

                </div>
                            

                <?php Session::forget('success');?>

                @endif

                @if ($message = Session::get('error'))

                <div class="custom-alerts alert alert-danger fade in">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>

                    {!! $message !!}
            
                </div>

                <?php Session::forget('error');?>

                @endif

              </div>
              </div>
              </div>
              </div>  






 

@endsection