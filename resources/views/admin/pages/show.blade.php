@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Pages</h2>
    </section>
     <section class="content">
       <div class="row">
           <div class="col-xs-12 margin-tb">

             <div class="pull-right">

                       <a href="{{ url('/admin/pages/') }}" class="btn btn-info btn-sm" title="Add New product">
                           <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                       </a>
               </div>
            </div>
      </div>


        <div class="table-responsive">
           <table class="table table-responsive">

                     <tr><th>Name</th><td> {{$page->name}}</td></tr>
                     <tr><th>Title</th><td> {{$page->title}}</td></tr>
                     <tr><th>Slug</th>  <td>{{$page->slug}}</td></tr>
                     <tr><th>Content</th>  <td>{!! $page->content !!} </td></tr>
                     <tr><th>Status</th> <td>{{$page->status}}</td></tr>


                            </table>
                        </div>




        </section>
    </div>
@endsection
