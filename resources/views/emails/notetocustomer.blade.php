<html>
<head><title></title>
  <style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: left;
    width:50%;
  }
  </style>
</head>
<body>
<div  style="padding:5px;margin:7px;border:1px solid black;">
<p>Dear Customer,</p>

<p>Please check below Note on your query.</p>
<table>
 <tr><td>Name</td><td>{{$contact->name}}</td></tr>
 <tr><td>Email</td><td>{{$contact->email}}</td></tr>
 <tr><td>Contact No</td><td>{{$contact->contactno}}</td></tr>
 <tr><td>Comment</td><td>{{$contact->subject}}{{$contact->message}}</td></tr>
 <tr><td>Note By Admin</td><td>{{$contact->note}}</td></tr>

</table>
Comments by administrator:


</div>
</body>
</html>
