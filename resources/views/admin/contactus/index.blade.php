@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <h2>Message</h2>
    </section>
     <section class="content">
        <div class="row">
            <div class="col-xs-12 margin-tb">


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
                        <form method="GET" action="{{ url('/admin/contactus') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th><th width="5%">Name</th><th width="5%">Contact No</th><th width="5%">E-Mail</th><th width="5%">Subject</th><th width="5%">Message</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{ $item->contactno }}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{ ucfirst($item->subject) }}</td>
                                        <td>{{ucfirst($item->message)}}</td>
                                        <td>
                                            @can('contact-list')
                                            <a href="{{ url('/admin/contactus/' . $item->id) }}" title="View Message"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan
                                            <a href="{{ url('/admin/contactus/' . $item->id . '/edit') }}" title="Edit Message"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/contactus' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Message" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $contacts->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
