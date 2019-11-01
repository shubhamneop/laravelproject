@extends('master')

@section('content')
  <div class="content-wrapper">
         <section class="content-header">
            <h2>Edit configuration #{{ $configuration->id }}</h2>
          </section>

        <section class="content">
             <div class="pull-right">
               <a href="{{ url('/admin/configurations') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            </div><br>

            {!! Form::model($configuration, [
                 'method' => 'PATCH',
                 'url' => ['/admin/configurations', $configuration->id],
                 'data-parsley-validate',
                 'files' => true
             ]) !!}

             @include ('admin.configurations.form', ['formMode' => 'edit'])

             {!! Form::close() !!}


        </section>
    </div>
@endsection
