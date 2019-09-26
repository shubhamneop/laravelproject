@extends('master')

@section('content')
  <div class="content-wrapper">
         <section class="content-header">
            <h2> Category #{{ $category->id }}</h2>
          </section>

        <section class="content">
          <div class="row">
            <div class="col-xs-12 margin-tb">
             <div class="pull-right">
               <a href="{{ url('/admin/categories') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

               </div>
            </div>
          </div>



                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr><th> Name </th><td> {{ ucfirst($category->category_name) }} </td></tr><tr><th> Parent </th>
                                       @if($category->parent)
                                      <td> {{ ucfirst($category->parent->category_name) }} </td>
                                       @else
                                       <td>-</td>
                                      @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>


        </section>
    </div>
@endsection
