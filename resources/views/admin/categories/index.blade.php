@extends('master')
@section('content')
 <div class="content-wrapper">
 	<section class="content-header">
 		<h2>Category</h2>
 	</section>
 	 <section class="content">
        <div class="row">
            <div class="col-xs-12 margin-tb">
       
              <div class="pull-left">
                 <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary btn-sm" title="Add New configuration">
                            <i class="fa fa-plus" aria-hidden="true"></i>  New Category
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
                        <form method="GET" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                      <th>#</th><th>Category</th><th>Parent</th><th>Actions</th>
                      </tr>
                    
                      </thead>
                      <tbody>

                      	 @foreach($categories  as $category) 
                      	    <tr> <td>{{ $loop->iteration }}</td>
                             <td>{{ $category->category_name }} </td> 

                             <td>


                                 @if($category->p_id == 0)

                                   -
                                 @else
                                     {{$category->parent->category_name}}
                                 
                              @endif
                              	</td><td>

                                <a href="{{ url('/admin/categories/' . $category->id) }}" title="View configuration"><button class="btn btn-info "><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    
                                            @can('category-edit')
                                            <a href="{{ url('/admin/categories/' . $category->id . '/edit') }}" title="Edit configuration"><button class="btn btn-success "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan
                                             @can('edit')
                                            <a href="{{ url('/admin/categories/' . $category->c2_id . '/edit') }}" title="Edit configuration"><button class="btn btn-success "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Sub </button></a>
                                            @endcan

                                            <form method="POST" action="{{ url('/admin/categories' . '/' . $category->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                 @can('category-delete')
                                                <button type="submit" class="btn btn-danger " title="Delete configuration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                @endcan
                                            </form>

                    






                             </td></tr>
                        
                         @endforeach
                      </tbody>
                
                     </table>  
                      

	  			{!! $categories->render() !!}

     </section>
 </div>

@endsection