@extends('master')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
     <h2> Configurations</h2>
     </section>

    <section class="content">
    <div class="row">
            <div class="col-xs-12 margin-tb">
                 @can('config-create')
              <div class="pull-left">
                 <a href="{{ url('/admin/configurations/create') }}" class="btn btn-primary btn-sm" title="Add New configuration">
                            <i class="fa fa-plus" aria-hidden="true"></i>  New Config
                        </a>
                </div>
                @endcan
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
                        <form method="GET" action="{{ url('/admin/configurations') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="">
                                    <button class="btn btn-info" type="submit" style="margin-left:-24;" >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                 </div>


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Value</th><th>Status</th><th width="280px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($configurations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($item->name) }}</td><td>{{ $item->value }}</td>
                                        <td>@if($item->status == 1)
                                            <span class="btn btn-success">  Active </span>
                                            @else
                                            <span class="btn btn-danger">  Inactive </span>
                                            @endif
                                         </td>


                                        <td>
                                            <a href="{{ url('/admin/configurations/' . $item->id) }}" title="View configuration"><button class="btn btn-info "><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @can('config-edit')
                                            <a href="{{ url('/admin/configurations/' . $item->id . '/edit') }}" title="Edit configuration"><button class="btn btn-success "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan

                                            <form method="POST" action="{{ url('/admin/configurations' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                 @can('config-delete')
                                                <button type="submit" class="btn btn-danger " title="Delete configuration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $configurations->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

    </section>
 </div>
@endsection
