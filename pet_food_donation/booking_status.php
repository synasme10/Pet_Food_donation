
<?php
include 'connection.php';

session_start();
if(!isset($_SESSION['acc']) || $_SESSION['type'] !="Reciever")
{
    header('location:login.php');
}


?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <title>Booking Status </title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family= Open Sans;">
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link type="text/css"  rel="stylesheet" href="css/all.css">


</head>
<a name="above"></a>
<body class="bg">
<div class="main">

    <div class="headuser">
        <div class="sub_headerone" >
            <div class="logo" >
                <img src="images/logo.jpg" alt="Spencer Animal Shelter logo" height="80" width="150" />
            </div>


            <div class="navbars">
                <ul type="none">

                    <li >
                        <div class="input-group" style="margin-top: 23px;">
                            <div class="form-outline">
                                <form action="searchName.php" method="get" role="form">
                                    <input type="text" name="name" class="form-control" placeholder="Search" size="9"/>

                            </div>
                            <button type="submit" class="btn btn-primary" >Search</button>
                            </form>
                        </div>

                    </li>
                    <li ><a href="food_dashboard.php" >FOODS</a></li>
                    <li ><a href="booking_status.php" >BOOKING STATUS </a></li>
                    <li ><a href="Forum_reciever.php" >Forum </a></li>
                    <li ><a href="reciever_update_profile.php" >
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

    <p style="margin-left: 370px; "><h1 style="color: white;" >Booking Status</h1></p>

    <table class='table table-dark' border='1' style='margin-left: 80px; width: 87%; ' >
    <?php
    $recieverid=$_SESSION['id'];
        $qry_selectall= "SELECT *
                         FROM booking_table AS b 
                        INNER JOIN fooddetail_table AS f ON f.fid= b.fid
                        INNER JOIN user_table AS ur ON ur.id=b.donarid
                        where recieverid='$recieverid'";
    $result = $conn->query($qry_selectall);
    if($result->num_rows > 0)
    {
        echo "
      <tr style='text-align: center'>
      <th style='text-align: center'>Bid</th>
        <th style='width:150px;text-align: center'>Food</th>
      <th style='text-align: center'>Food_name</th>
      <th style='text-align: center'>Quantity</th>
      <th style='width:200px;text-align: center '>Description</th>
      <th style='text-align: center'>Donar Name</th>
	  <th style='text-align: center;width: 150px;'>Address</th>
	  <th style='text-align: center'>Contact </th>
	  <th style='width:150px;text-align: center'>Approved</th>
	</tr>";
        while($food = $result->fetch_assoc())
        {
            $approved=$food['booking_status'];
            $contactno=$food['Phone'];
                echo "<tr>
	<td style='color: white'>" . $food['id'] . "</td>
	<td><img src='Foodimage/" . $food['img_name'] . "' height='90' width='130' /></td>
		<td style='color: white'>" . $food['food_name'] . "</td>
		<td style='color: white'>" . $food['quantity'] . "</td>
		<td style='color: white'>" . $food['description'] . "</td>
	<td style='color: white'>" . $food['Name'] . " <br/>" . $food['Email'] . "</td>
	<td style='color: white'>Province No. " .$food['Provinces'] . ", <br/> " .$food['Address'] . ", " .$food['City'] . "</td>
		<td>       
		";
            if ($approved == 1) {
              echo "$contactno";
            } else {
                echo "-";
            }
            echo "</td>
		
		<td>       
		";
                if ($approved == 1) {
                    echo "<span style=\"background-color: green; padding: 2px 2px; width:110px;height: 25px;\">Approved</span>";
                } else {
                    echo "<span style=\"background-color: red;padding: 2px 2px;width:110px;height: 25px;\">Not Approved</span>";
                }
                echo "</td>";

        }

    }
    else
    {
        echo "<span style='color:#ffffff;'>Data not found</span>";
    }

    echo "<table>";
    ?>
</div>
</body>
</html>