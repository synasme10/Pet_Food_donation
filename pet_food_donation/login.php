<?php
include 'connection.php';

if(isset($_POST['back']))
		{
		header("location:index.php");
		}
		
	//Alert message if password and username is invalid	
	if(isset($_GET['Attempts']))
	{
    echo '<script> alert(" Invalid Username and Password")</script>';
	}

	//if attempt for 3 time blocking for 5 min;
//	 if(isset($_COOKIE['try']) && $_COOKIE['try']==3)
//	{
//    echo " <h1 style='text-align:center; Background-color:black;
//	color:white;'> ------Blocked for 5 Minutes------</h1> ";
//     echo '<form method="POST">
//				<b><input style="margin-left:45em; color:white; width:60px;
//					font-size:15px; height:50px; background:black;"
//					type="submit" name="back" value="Back"/ ></b>
//			</form>';
//     die();
//	}

if(isset($_POST['login']))
{
$Username=$_POST['name'];
$Password=$_POST['password'];
$qry_sel="SELECT * FROM user_table  WHERE Account='$Username' and Password='$Password'";
$result= $conn->query($qry_sel);
if($result->num_rows > 0)
{
		session_start();
		$value=$result-> fetch_assoc();
		$_SESSION['acc']= $value['Account'];
		$_SESSION['name']=$value['Name'];
		$_SESSION['type']= $value['Type'];
		$_SESSION['id']= $value['id'];
		$_SESSION['address']= $value['Address'];
        $_SESSION['phone']= $value['Phone'];
		$_SESSION['date']= $value['Signup_date'];

         $TodayDate = date("Y-m-d");
        $visiteddate = date(($_SESSION['date']));
        $visitedtime = strtotime($visiteddate);
        $todaytime = strtotime($TodayDate);
        $difference = (($todaytime - $visitedtime) / (60 * 60 * 24 * 30));

        if ($difference > 24) {
            $userid=$_SESSION['id'];
            $delete_user="DELETE FROM user_table WHERE id='$userid'";
            if($conn->query($delete_user) == TRUE)
				{
				echo ("Delete user Error: ".$conn->error);
				}
			session_destroy();
			header("Location: index.php");
			} 
		else {
        $update_date="UPDATE user_table SET Signup_date='$TodayDate' WHERE id='$userid'";
			if($conn->query($update_date) == FALSE)
			{
			die("Update date Error: ".$conn->error);
			}
				if($_SESSION['type']=="Admin")
				{
				header('location:adminpage.php');
				}
				else if ($_SESSION['type']=="Donar")
				{
				header('location:donar.php');
				}
				else
                {
                    header('location:food_dashboard.php');
                }

		}
		}
		else
            {
				
			if (isset($_COOKIE['try'])) {
				 // Increasing wrong attempt further
            setcookie('try', $_COOKIE['try'] + 1, time() + 300);
            $count = $_COOKIE['try'];
			echo "Attempts ".$count."<br/>";
			header("location:login.php?Attempts=$count");
				} else {
					// Wrong attempts for first time
					setcookie('try', 1);  
					$count = $_COOKIE['try'];
					header("location:login.php?Attempts=$count");
				}
			}
        }


        if(isset($_POST['signup'])){
        	session_start();
        if(session_destroy())
        {
        header('location:signup.php');
        }
        }
		
	
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link type="text/css"  rel="stylesheet" href="css/form.css">
</head>
<body style="background-image: url('images/bf.jpg');no-repeat 0px 0px;">
	<div class="login">
		<div class="sublogin">
			<div class="cancel">
				<a href="logout.php" title="cancel" >
				<img src="images/backto.png" alt="fbIcon" height="50" width="50"/></a>
			</div>
        <h1>Login</h1>    
	<form  method="post" name="logfrm">
        <span class="logintextfield">
           <input type="text" id="username" placeholder="Username" name="name" type="username"/>
	   </span>
       <input type="password" id="password" placeholder="Password" name="password" type="password"/>
       <span class="submitlog">
		 <input type="submit" name="login" value="LOGIN" onclick="return val()"/> </span> 
       <span class="submitlog"><input type="submit" value="SIGN UP" name="signup"/> </span>
	</form>
    <script>
	function val()
		{
		var u=document.forms['logfrm']['username'].value;
		var p=document.forms['logfrm']['password'].value;

		if(u=="" || p=="" )
			{
			alert ("One field is empty...Please fill ");
			return false;
			}
		}   
	</script>
</div>
</div>

</body>
</html>
