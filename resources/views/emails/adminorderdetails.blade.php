
<html>
<head>
	<title></title>
	 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <style type="text/css">
	.header{
		position: relative;

		float:left;
		height: 110px;
		text-align:center;
		background-color: lightblue;
	}
	.clearfix {
  overflow: auto;
      }
 .row {
    margin-right: -15px;
    margin-left: -15px;
		width: 919px;
 }
 .col-md-6 {
    width: 50%;
 }
 .col-md-4 {
    width: 33.33333333%;
 }
 .col-md-2{
	width: 16.6777777%;
 }
 table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: left;
    width:auto;
  }
</style>
</head>
<body   style="border: 1px solid black;padding: 19px;margin: 5px;height:auto;">
  <p>Dear Administrator,</p>

  <p>Please check below details of Orders.</p>
	<br>
	<div style="margin-top: 10px;">

 <center>
<table>
  <tr><th>Sr No</th>
<th>Product</th>
<th>Quantity</th>
<th>Unit Price</th>
<th>User name</th>
</tr>

	@foreach($orders as $order)


    @foreach($order->cart->items as $item)
       <tr>
      <td>{{$loop->iteration}}</td>
      <td> {{$item['item']['name']}}</td>
      <td> {{$item['qty']}}</td>
      <td>{{$item['price']}}</td>
			<td>{{$order->address['fullname']}}</td>

		</tr>

 @endforeach



@endforeach
</table>
</center>


   </div>
</body>

</html>
