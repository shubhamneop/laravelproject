@extends('master')

@section('content')
 <div class="content-wrapper "style="min-height: 100%">
        <section class="content-header">
        <h2>Create New configuration</h2>
        </section>
     <section class="content">

        <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-right">
              <a href="{{ url('/admin/configurations') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden=""></i> Back</button></a>
                 </div>
             </div>
          </div>




                        <form method="POST" action="{{ url('/admin/configurations') }}" accept-charset="UTF-8"  enctype="multipart/form-data" data-parsley-validate>

                            {{ csrf_field() }}
                            <div class="row">
                            @include ('admin.configurations.form', ['formMode' => 'create'])
                          </div>
                        </form>





     </section>
  </div>
@endsection
