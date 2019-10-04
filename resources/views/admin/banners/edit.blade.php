@extends('master')

@section('content')
    <div class="content-wrapper">
         <section class="content-header">
           <h2>Edit banner # {{$banner->id}}</h2>
         </section>
       <section class="content">
            <div class="row">
                <div class="col-xs-12 margin-tb">
                   <div class="pull-right">
                     <a href="{{ url('/admin/banners') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                </div>
            </div>
            {!!Form::model($banner,['method'=>'PATCH','url'=>['admin/banners',$banner->id],'data-parsley-validate','file'=>true])!!}

                @include ('admin.banners.form', ['formMode' => 'edit'])

           {!!Form::close()!!}

        </section>
    </div>
@endsection
