
<td>
@foreach($childs as $child)

	

	    {{ $child->category_name }}

	@if(count($child->childs))

            @include('manageChild',['childs' => $child->childs])

        @endif

	

@endforeach

</td>