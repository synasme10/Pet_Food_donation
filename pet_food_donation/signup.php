
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="UTF-8">
<title>Sign up</title>
<link type="text/css"  rel="stylesheet" href="css/form.css">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald">
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <head>
<body style="background-image: url('images/bf.jpg');no-repeat 0px 0px;">

<?php
include "connection.php";
if(isset($_POST['cancel']))
	{
	session_start();
	if(session_destroy())
	{
	header('location:login.php');
	}}
	
	//Registering user 
	if(isset($_POST['register']))
		{
	$name = $_POST['name'];
	$address = $_POST['address'];
	$provinces=$_POST['provinces'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$account = $_POST['account'];
	$pwd = $_POST['password'];
	$type = $_POST['usertype'];
	$date=date("Y-m-d");

	$qry_register="INSERT INTO user_table VALUES('','$name',
	'$address','$provinces','$city','$phone','$email','$account','$pwd',
	'$type','$date')";
	if($conn->query($qry_register) == FALSE)
	{
	die("Error: ".$conn->error);
	}
	echo '<script>alert("Registered Completed")</script>';
	}

?>
<div class="register">
	<div class="forms">
		     <div class="cancel">
        <a href="logout.php" title="cancel" ><img src="images/backto.png" alt="fbIcon" height="50" width="50"/></a>
      </div>
<h1>SIGNUP</h1>
<form method="post" name="regfrm">
	<label class="label">Full name: </label>
<input type="text" class="text" name="name" Placeholder="Your Name" /><br />
<label class="label">Address: </label>
<input type="text" class="text" name="address" Placeholder="Your Address"  /><br />
<label class="label">Provinces No.: </label>
<input type="text" name="provinces" Placeholder="Provinces No" /><br />
<label class="label">City: </label>
<input type="text" name="city" Placeholder="City"/>
<label class="label">Phone: </label>
<input type="text" class="text" name="phone" Placeholder="Your Phone Number" /><br />
<label class="label">Email:</label>
<input type="email" name="email" Placeholder="Your Email Address"  /><br /><br />
<label class="label">Username:</label>
<input type="text"  id="account" name="account" Placeholder="Your Username" onkeyup="exist()" />
<span style=' margin-left: -4em; color:white;'>Check Availability</span>
<span id="show"></span><br/><br/>
    <label class="label">User Type:</label>
    <div class="form-group" style="width:650px;">
       <select name="usertype" id="usertype" class="form-control">
                <option value="Donar">Waste Food Donar</option>
                <option value="Reciever">Food Reciever</option>
            </select>
    </div>
    <br/>


<label class="label">Password:</label>
 <input type="password" name="password" Placeholder="Password"  /><br />
<label class="label">Confirm Password:</label> 
<input type="password" name="conpassword" Placeholder="Confirm Password"  /><br /><br />
<input type="submit" name="register" value="Register" onclick="return val()"/>
<input type="submit" name="cancel" value="Login" />
</form>
<script>
function val()
{

if (confirm("R U SURE?") == true)
{
var n=document.forms['regfrm']['name'].value;
var a=document.forms['regfrm']['address'].value;
var ps=document.forms['regfrm']['provinces'].value;
var c=document.forms['regfrm']['city'].value;
var p=document.forms['regfrm']['phone'].value;
var e=document.forms['regfrm']['email'].value;
var acc=document.forms['regfrm']['account'].value;
var pw=document.forms['regfrm']['password'].value;
var pwd=document.forms['regfrm']['conpassword'].value;

// var regp=/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

if(n=="" || a=="" || ps=="" || c=="" || p=="" || e=="" ||acc=="" ||pw=="" ||pwd=="")
{
alert ("Empty field");

return false;
}
else if (pw!=pwd)
{
    alert("Password and confirm password doesn't Match")
    return false;
}

// else if(!p.match("regp"))
// {
 // alert ('Phone is not validated...Please account the problem');
 // return false;
// }
}
else
{
	return false;
}
}	
</script> 

<script>
function exist()
{
var user = document.getElementById("account").value;
var req;
if(window.XMLHttpRequest)
{
req = new XMLHttpRequest()
}
else
{
req = new ActiveXObject("Microsoft.XMLHTTP");
}

req.onreadystatechange=function()
{
	if (req.readyState==4 && req.status==200) 
	{
	document.getElementById("show").innerHTML = req.responseText;	
	}
}
req.open("GET","Checking.php?value="+user,true);
req.send();
}
	
</script>


</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>