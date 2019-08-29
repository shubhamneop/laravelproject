@extends('master')
@section('content')
  <div class="content-wrapper">
      <section class="content-header">
         <h2> Role #{{$role->name}} </h2>
       </section>
      <section class="content">
            
        <div class="row">
            <div class="col-lg-12 margin-tb">
       
              <div class="pull-right">
               <a class="btn btn-primary" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                 </div>
             </div>
          </div>
          <div class="row">
             <table class="table">
                <tbody>
                 <tr>
                 <th>Name</th><td>{{ $role->name }}</td>
                  </tr>                
                   <tr><th> Role </th>
                   <td> 
                     @if(!empty($permissions))
                        @foreach($permissions as $v)
                         <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                      @endif
                    </td></tr>
                </tbody>
              </table>
                        
       </div>
    
      </section>

   </div>

@endsection