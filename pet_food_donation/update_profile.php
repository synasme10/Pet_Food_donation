<?php
include 'connection.php';

session_start();
if(!isset($_SESSION['acc']))
{
    header('location:login.php');
}


$name="";
$address="";
$provinces="";
$city="";
$gender="";
$phone="";
$email="";
$account="";
$pwd="";

if (isset($_SESSION['name']))
{
    $userid=$_SESSION['id'];
//Selecting the user detail from usertable who ever is active..
    $qry_userselect= "SELECT * FROM user_table WHERE id='$userid'";
    $result_user = $conn->query($qry_userselect);
    $row_value= $result_user->fetch_assoc();
    $name = $row_value['Name'];
    $address = $row_value['Address'];
    $provinces=$row_value['Provinces'];
    $city = $row_value['City'];
    $phone =$row_value['Phone'];
    $email = $row_value['Email'];
    $account = $row_value['Account'];
    $type=$row_value['Type'];
    $pwd = $row_value['Password'];
}

//update user table
if(isset($_POST['updateuser']))
{
    $userid=$_SESSION['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $provinces=$_POST['provinces'];
    $city = $_POST['city'];
    $phone =$_POST['phone'];
    $email = $_POST['email'];
    $account = $_POST['account'];
    $password = $_POST['password'];

    $qry_userupdate = "UPDATE user_table SET Name='$name', Address='$address', Provinces='$provinces', City='$city', Phone='$phone', 
       Email='$email', Account='$account' ,Password='$password' WHERE id='$userid'";
    if($conn->query($qry_userupdate) == FALSE)
    {
        die("Update user Error: ".$conn->error);
    }
    echo '<script>alert("Updated successfully")</script>';
}
?>


<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <title>Donar Dashboard</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family= Open Sans;">
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link type="text/css"  rel="stylesheet" href="css/form1.css">
    <link type="text/css"  rel="stylesheet" href="css/form.css">
    <link type="text/css"  rel="stylesheet" href="css/all.css">

</head
<a name="above"></a>
<body>
<div class="main">
    <div class="headuser">
        <div class="sub_headerone">
            <div class="logo">
                <img src="images/logo.jpg" alt="Spencer Animal Shelter logo" height="80" width="150" />
            </div>

            <div class="navbar">
                <ul type="none" >
                    <li ><a href="donar.php" >Donate Food</a></li>
                    <li ><a href="donar_bookingstatus.php" >BOOKING STATUS </a></li>
                    <li ><a href="forum.php" >FORUM </a></li>
                    <li ><a href="update_profile.php" >
                            <?php $acc=$_SESSION['acc'];
                            echo $acc; ?> </a></li>
                    <li ><a href="logout.php" >LOG OUT</a></li>
                </ul>
            </div>

        </div>
        <div class="social">
            <div class="facebook">
                <a href="https://www.facebook.com" title="Facebookpage" target="_blank"><img src="images/Facebook.png" alt="fbIcon" height="50" width="50"/></a>
            </div>
            <div class="instagram">
                <a href="https://www.instagram.com"  title="Instagrampage" target="_blank"><img src="images/Instagram.png" alt="instagramIcon" height="50" width="50"/></a>
            </div>
            <div class="Twitter">
                <a href="https://www.twitter.com"  title="Twitterpage" target="_blank"><img src="images/Twitter.png" alt="twitterIcon" height="50" width="50"/></a>
            </div>
            <div class="youtube">
                <a href="https://www.youtube.com"  title="Youtubepage" target="_blank"><img src="images/Youtube.png" alt="InstagramIcon" height="50" width="50"/></a>
            </div>
        </div>
    </div>

    <div class="register">
        <div class="forms">
            <h1>Change Profile</h1>
            <form method="POST" name="regfrm">
                <label class="label">Full name: </label>
                <input type="text" class="text" name="name" Placeholder="Your Name" value="<?php echo $name?>"/><br />
                <label class="label">Address: </label>
                <input type="text" class="text" name="address" Placeholder="Your Address" value="<?php echo $address?>" /><br />
                <label class="label">Provinces No.: </label>
                <input type="text" name="provinces" Placeholder="Provinces No" value="<?php echo $provinces?>"/><br />
                <label class="label">City: </label>
                <input type="text" name="city" Placeholder="City" value="<?php echo $city?>"/>
                <label class="label">Phone: </label>
                <input type="text" class="text" name="phone" Placeholder="Your Phone Number" value="<?php echo $phone?>" /><br />
                <label class="label">Email:</label>
                <input type="email" name="email" Placeholder="Your Email Address" value="<?php echo $email?>" /><br /><br />
                <label class="label">Username:</label>
                <input type="text"  id="account" name="account" Placeholder="Your Username" value="<?php echo $account?>" onkeyup="exist()" />
                <span style=' margin-left: -4em; color:white;'>Check Availability</span>
                <span id="show"></span><br/><br/>
                <br/>


                <label class="label">Password:</label>
                <input type="password" name="password" Placeholder="Password" value="<?php echo $pwd?>" /><br />
                <label class="label">Confirm Password:</label>
                <input type="password" name="conpassword" Placeholder="Confirm Password" value="<?php echo $pwd?>" /><br /><br />
                <input type="submit" name="updateuser" value="Change Profile"  onclick="return val()"/>
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

    <div class="footer">
        <h2>Contact Us</h2>
        <div class="ephone">
            <div class="ephone1"><img src="images/phone.png" alt="GKClogo" height="60" width="60"/></div>
            <div class="ephone2"><img src="images/Email.png" alt="GKClogo" height="60" width="60"/></div>
        </div>
        <div class="info">
            Reclying Waste Foods, Nepal<br><br>
            +977-1-423 2455, 224 8511 <br><br>
            Email : reclyclefood10@gmail.com
        </div>


        <div class="copyright">
            <p>©2021 COPYRIGHT RWF, All Rights Reserved & Privacy Terms</p>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</div>
</body>
</html>
