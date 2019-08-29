@extends('master')

@section('content')
  <div class="content-wrapper">
         <section class="content-header">
            <h2>Edit configuration #{{ $configuration->id }}</h2>
          </section>

        <section class="content">
             <div class="pull-right">
               <a href="{{ url('/admin/configurations') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            </div>
                     

                        <form method="POST" action="{{ url('/admin/configurations/' . $configuration->id) }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="row">
                            @include ('admin.configurations.form', ['formMode' => 'edit'])
                            <div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
