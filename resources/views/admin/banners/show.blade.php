@extends('master')

@section('content')
 <div class="content-wrapper">
       <section class="content-header">
          <h2> Banner {{$banner->id}}</h2>
        </section>
    <section class="content">
           <div class="row">
               <div class="col-xs-12 margin-tb">
                  <div class="pull-right">
                        <a href="{{ url('/admin/banners') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                      <!--    <a href="{{ url('/admin/banners/' . $banner->id . '/edit') }}" title="Edit banner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/banners' . '/' . $banner->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                     <button type="submit" class="btn btn-danger btn-sm" title="Delete banner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                              </form> -->
                    </div>
                 </div>
            </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $banner->id }}</td>
                                    </tr>
                                    <tr><th> Name </th>
                                    <td> {{ ucfirst($banner->name) }} </td>
                                    </tr>
                                    <tr><th> Banner Image </th>
                                    <td ><img src="{{asset('/storage/' .$banner->bannername)}}"> </td>
                                    </tr>
                                </tbody>
                            </table>
                </div>

        </section>
    </div>
@endsection
