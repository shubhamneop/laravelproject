@extends('master')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
     <h2> Banners</h2>
     </section>

    <section class="content">
    <div class="row">
            <div class="col-xs-12 margin-tb">

              <div class="pull-left">
                 <a href="{{ url('/admin/banners/create') }}" class="btn btn-primary btn-sm" title="Add New configuration">
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
                        <form method="GET" action="{{ url('/admin/banners') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Banner Image</th><th width="280px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td><td> <img src="{{asset('/storage/' .$item->bannername)}}"  style="width:50px;height:70px;"></td>
                                        <td>
                                            <a href="{{ url('/admin/banners/' . $item->id) }}" title="View banner"><button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/banners/' . $item->id . '/edit') }}" title="Edit banner"><button class="btn btn-success "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/banners' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger " title="Delete banner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $banners->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

        </section>
    </div>
@endsection
