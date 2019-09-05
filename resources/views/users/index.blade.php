@extends('master')

@section('content')
    <div class="content-wrapper" style="min-height: 926px">
        <section class="content-header">

                <h2>User Management</h2>

        </section>
        <section class="content">
         <div class="row">
                 @can('user-create')
            <div class="col-lg-1 col-xs-1">
             <a class="btn btn-primary" href="{{route('users.create')}}"><i class="fa fa-plus" aria-hidden="true"></i> New User</a>
            </div>
                    @endcan
         </div>
            @if($message = Session::get('success'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                      <p>{{$message}}</p>
                </div>
             @endif


           @can('user-list')


             <div class="row" style="float:right;">
                     <div class="pull-right col-xs-12">
                        <form method="GET" action="{{ url('users') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="btn btn-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>

                        <td>
                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                            @can('user-edit')
                            <a class="btn btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                            @endcan
                            @can('user-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            <button onClick="javascript: return confirm('Are you sure to delete it ?');" class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            {!! Form::close() !!}
                                @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
          @endcan

            {!! $data->render() !!}
















        </section>
    </div>

@endsection
