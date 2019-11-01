@extends('layouts.app')


@section('content')

        <div>
					@foreach($data as $image)
					@foreach($image->image as $d)
  <img width="100px" src="{{$d->url}}">
 @endforeach
 @endforeach

</div>

@endsection
