@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">configuration {{ $configuration->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/configurations') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/configurations/' . $configuration->id . '/edit') }}" title="Edit configuration"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('configurations' . '/' . $configuration->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete configuration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $configuration->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $configuration->name }} </td></tr><tr><th> Value </th><td> {{ $configuration->value }} </td></tr><tr><th> --view-path=admin Dash --controller-namespace=Admin Dash --route-group=admin Dash --form-helper=html
Php Artisan Crud:generate Configurations --fields=name </th><td> {{ $configuration->--view-path=admin_dash --controller-namespace=Admin_dash --route-group=admin_dash --form-helper=html
php artisan crud:generate configurations --fields=name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
