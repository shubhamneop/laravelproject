@extends('master')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show User</h2>
            </div>

        </div>
    </section>
   <section class="content">

   <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
       <div class="row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Name</th><td>{{ $users->fullname }}</td>
                                    </tr>
                                    <tr><th> Email </th><td> {{ $users->email }} </td></tr>
                                    <tr><th> Role </th>
                                    <td>
                                     @if(!empty($users->getRoleNames()))
                                          @foreach($users->getRoleNames() as $v)
                                             <label class="label label-success">{{ $v }}</label>
                                           @endforeach
                                @endif </td></tr>
                                </tbody>
                            </table>

       </div>

   </section>


 </div>

@endsection
