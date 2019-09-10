@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Pages</h2>
    </section>
     <section class="content">
       <div class="row">
           <div class="col-xs-12 margin-tb">

             <div class="pull-left">

                       <a href="{{ url('/admin/pages/create') }}" class="btn btn-info btn-sm" title="Add New product">
                           <i class="fa fa-plus" aria-hidden="true"></i> Add New
                       </a>
               </div>
            </div>
      </div>
         @if($message = Session::get('success'))

           <div class="alert alert-success">
           <button type="button" class="close" data-dismiss="alert">×</button>
               <p>{{$message}}</p>
          </div>
         @endif
                     <div class="row" style="float:right;">
                     <div class="pull-right col-xs-12">
                        <form method="GET" action="{{ url('/admin/pages') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                             <div class="">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="">
                                    <button class="btn btn-info" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Title</th><th>Slug</th><th>Content</th><th>Extra</th><th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($pages as $page)



                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td> {{$page->name}}</td>
                                        <td> {{$page->title}}</td>
                                        <td>{{$page->slug}}</td>
                                        <td>{{$page->content}} </td>
                                        <td>{{$page->extras}}</td>


                                <td>
                                    @can('order-list')
                                    <a href="{{ url('/admin/pages/' . $page->id) }}" title="View coupon"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    @endcan
                                    <a href="{{ url('/admin/pages/' . $page->id . '/edit') }}" title="Edit coupon"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                    <form method="POST" action="{{ url('/admin/pages'  . '/' . $page->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete coupon" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                              </tr>
                              @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $pages->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>




        </section>
    </div>
@endsection
