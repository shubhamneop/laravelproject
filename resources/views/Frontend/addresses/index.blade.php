@extends('Frontend.masterfrontend')

@section('content')
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/addresses/create') }}" class="btn btn-success btn-sm" title="Add New Address">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                         
                        <form method="GET" action="{{ url('/addresses') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="pull-right">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Full Name</th><th>Address1</th><th>Address2</th><th>Zipcode</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($addresses as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->fullname}}</td>
                                        <td>{{ $item->address1 }}</td><td>{{ $item->address2 }}</td><td>{{ $item->zipcode }}</td>
                                        <td>
                                            <a href="{{ url('/addresses/' . $item->id) }}" title="View Address"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/addresses/' . $item->id . '/edit') }}" title="Edit Address"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/addresses' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Address" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $addresses->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
