
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
		width: 956px;
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
	<div class="row">
		<div class="header col-md-6 " style="border-right: 4px dashed lightgray;">
			<p>
		<b>THANK YOU FOR YOUR ORDER FROM INDIA BBT.</b><br>
You can check the status of your order by logging into your account.</p>
	  </div>
		<div class="header col-md-4 ">

		Call Us: +91 - 22 - 40500699
     Email: info@shoppingcompany.com
  </div>

	</div>
	<br>
	<div style="margin-top: 10px;">
	<center><b style="font-size: 20px;">Your Order{{$order->id}} </b></center>
   <center>Your Shipment #{{$order->status}} </center>
	<center> </center><br>
 <center>
<table>
<tr>
<td>Tracking Code</td>
<td>{{$order->id}}</td>


</tr>

</table>

</center>

<br>

<center>
	<b>BILL TO</b>
<table>

	 <tr><td>Billing Address</td><td>{{$order->address->fullname}} {{$order->address->address1}} {{$order->address->address2}} {{$order->address->zipcode}} {{$order->address->country}} {{$order->address->state}}</td></tr>
	 <tr><td>Shipping Address</td><td>{{$order->address->fullname}} {{$order->address->address1}} {{$order->address->address2}} {{$order->address->zipcode}} {{$order->address->country}} {{$order->address->state}}</td></tr>


</table>


 </center>
   </div>
</body>

</html>
