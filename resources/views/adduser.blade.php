<head>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        * {box-sizing: border-box;}

        input[type=text], select, number{
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=number],[type=password],[type=email]{

            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
    <title>Registration</title>
</head>

<div class="container">
  @foreach($order as $item)
<tr>

    {{$item}}

</tr>
@endforeach


<table id="example2" class="table table-bordered table-hover" role="grid">
    <thead>
   <tr>
      <th>#</th>
       <th>Item image</th>
       <th>ProductName</th>
       <th>Price</th>
       <th>Quantity</th>
       <th>Category</th>

   </tr>
 </thead>
 <tbody>
   @foreach($order as $item)
       <tr>
           <td>{{$item->order_id}}</td>
             <td>  <img src="{{asset('product/' .$item->product_image)}}" alt="product image" width="60px" height="60px" /></td>
           <td>{{strtoupper($item->product_name)}}</td>
           <td>{{$item->price}}</td>
           <td>{{$item->quantity}}</td>
           <td>{{$item->categoryname->category_name}}</td>
       </tr>

@endforeach
</tbody>

</table>
    <!-- {!!  Form::open(array('method'=>'post')) !!}
    {{ csrf_field() }}
    {!!  Form::label('Firstname','Firstname : ') !!}
    {!! Form::text('Firstname')!!}


    {!! Form::label('Lastname','Lastname : ')!!}
    {!! Form::text('Lastname')!!}

    {!! Form::label('Gender','Gender : ')!!}
    {!! Form::label('Gender','Male : ')!!}
    {!! Form::radio('Gender','male',true)!!}
    {!! Form::label('Gender',' Female : ')!!}
    {!! Form::radio('Gender','female')!!}

    {!!  '<br>'!!}

    {!! Form::label('Email','Email : ')!!}
    {!! Form::text('Email')!!}

    {!! Form::label('Contact No','Contact No : ')!!}
    {!! Form::text('contactno')!!}

    {!! Form::label('City','Select Your City : ')!!}
    {!! Form::select('City',array('Amravati'=>'Amravati','Pune'=>'Pune','Mumbai'=>'Mumbai','Nashik'=>'Nashik'),'P')!!}

    {!! Form::label('Username','Username : ')!!}<span style="color: red">{{ $errors->first('username') }}</span>
    {!! Form::text('username')!!}

    {!! Form::label('Password','Password : ')!!}<span style="color: red">{{ $errors->first('password') }}</span>
    {!! Form::password('password')!!}

    {!! Form::submit('Submit')!!}
    {!!  Form::close()!!} -->

</div>
