<html>
<head><title></title></head>
<body>
<div  style="padding:5px;margin:7px;border:1px solid black;height:auto;width:auto;">
<h1>Welcome to My Shopping Cart</h1>
<p>To log in when visiting our site just click<a href="http://127.0.0.1:8000/login">Login</a>or <a href="http://127.0.0.1:8000/profile">My Account</a>at the top of every page, and then enter youy email address and password</p>

<div style="background-color:lightgrey;color:black;width:auto;height:70px;">
use this following values when prompted to log in:<br/>
Email:{{$user->email}}<br/>
Password:{{$user->password}}
</div>
When you log in to your account, you will be able to do the following:




<ul>
<li>Proceed through checkout faster when making a purchase</li>
<li>Check the status of orders</li>
<li>View past orders</li>
<li>Make changes to your account information</li>
<li>Change your password</li>
<li>Store alternative addresses (for shipping to multiple family members and friends!)</li>
</ul>


If you have any questions, please feel free to contact us at
info@shoppingcompany.com or by phone at +91-022-45698756
</div>
</body>
</html>
