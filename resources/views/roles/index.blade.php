@extends('master')

@section('content')
  <div class="content-wrapper "style="min-height: 100%">
       <section class="content-header">
           <h2>Role Management</h2>
           
       </section>
      <section class="content">
         <div class="row">
             @can('user-create')
               <div class="col-lg-1 col-xs-1">
                  <a class="btn btn-primary" href="{{route('roles.create')}}"><i class="fa fa-plus" aria-hidden="true"></i> New Role</a>
                </div>
                    @endcan
           </div>
            @if($message = Session::get('success'))
              <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>	
                 <p>{{$message}}</p>
               </div>
           @endif



             <div class="row" style="float:right;">
                     <div class="pull-right col-xs-12"> 
                        <form method="GET" action="{{ url('roles') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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






          @can('role-list')
          <table class="table table-bordered">
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th width="280px">Action</th>
              </tr>
              @foreach ($roles as $key => $role)
                  <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                          @can('role-list')
                          <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                          @endcan
                          @can('role-list')
                              <a class="btn btn-success" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                          @endcan
                          @can('role-list')
                              {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                              <button onClick="javascript: return confirm('Are you sure to delete it ?');" class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                              {!! Form::close() !!}
                          @endcan
                      </td>
                  </tr>
              @endforeach
          </table>

         @endcan
          {!! $roles->render() !!}






























      </section>

  </div>


@endsection