@extends('master')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
     <h2> Emailtemplates</h2>
     </section>

    <section class="content">
      <div class="row">
              <div class="col-xs-12 margin-tb">

                <div class="pull-left">
                  <a href="{{ url('/admin/email-templates/create') }}" class="btn btn-success btn-sm" title="Add New EmailTemplate">
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
                         {!! Form::open(['method' => 'GET', 'url' => '/admin/email-templates', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                         <div class="">
                             <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                             <span class="">
                                 <button class="btn btn-primary" type="submit">
                                     <i class="fa fa-search"></i>
                                 </button>
                             </span>
                         </div>
                         {!! Form::close() !!}

                       </div>
                  </div>



                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Subject</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($emailtemplates as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->subject }}</td>
                                        <td>
                                            <a href="{{ url('/admin/email-templates/' . $item->id) }}" title="View EmailTemplate"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/email-templates/' . $item->id . '/edit') }}" title="Edit EmailTemplate"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/email-templates', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete EmailTemplate',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $emailtemplates->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>


        </section>
    </div>
@endsection
