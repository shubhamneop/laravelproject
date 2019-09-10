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
            <form id="banner-form" method="POST" action="{{ url('/admin/banners/' . $banner->id) }}" accept-charset="UTF-8"  enctype="multipart/form-data">
               {{ method_field('PATCH') }}
               {{ csrf_field() }}
                 <div class="row">
                @include ('admin.banners.form', ['formMode' => 'edit'])

                </div>
            </form>

        </section>
    </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
  $('#banner-form').parsley();
});
</script>

@endsection
