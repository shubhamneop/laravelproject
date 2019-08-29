@extends('master')

@section('content')
  <div class="content-wrapper">
         <section class="content-header">
            <h2> Configuration #{{ $configuration->id }}</h2>
          </section>

        <section class="content">
          <div class="row">
            <div class="col-xs-12 margin-tb">
             <div class="pull-right">
               <a href="{{ url('/admin/configurations') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                      <!--  <a href="{{ url('/admin/configurations/' . $configuration->id . '/edit') }}" title="Edit configuration"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/configurations' . '/' . $configuration->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete configuration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                   -->
               </div>    
            </div>
          </div> 
                        
                       

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                  
                                    <tr><th> Name </th><td> {{ $configuration->name }} </td></tr><tr><th> Value </th><td> {{ $configuration->value }} </td></tr>
                                </tbody>
                            </table>
                        </div>

              
        </section>
    </div>
@endsection
