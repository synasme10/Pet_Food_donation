
<?php
include 'connection.php';

session_start();
if(!isset($_SESSION['acc']) || $_SESSION['type'] !="Donar")
{
    header('location:login.php');
}

$bookingstatus="";

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $qry_selectrow = "SELECT * FROM booking_table WHERE id='$id'";
    $result_food = $conn->query($qry_selectrow);
    $value_row= $result_food->fetch_assoc();
    $bookingstatus = $value_row['booking_status'];

}

if(isset($_POST['update']))
{
    $id=$_GET['id'];
    $status = (isset($_REQUEST['status']));
    if ($status == 1 )
    {
        $status = 1;
    }
    else
    {
        $status = 0;
    }

    $qry_update = "UPDATE booking_table SET   
	   booking_status='$status' WHERE id='$id'";
    if($conn->query($qry_update) == FALSE)
    {
        die("Error: ".$conn->error);
    }
    header('location:donar_bookingstatus.php');
    echo '<script>alert("Updated successfully")</script>';

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
    <link type="text/css"  rel="stylesheet" href="./css/form1.css">
    <link type="text/css"  rel="stylesheet" href="css/all.css">


</head>
<a name="above"></a>
<body class="bg">
<div class="main">

    <div class="headuser">
        <div class="sub_headerone" >
            <div class="logo">
                <img src="images/logo.jpg" alt="Spencer Animal Shelter logo" height="80" width="150" />
            </div>

            <div class="navbars">
                <ul type="none">
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

    <p style="margin-left: 370px; "><h1 style="color: white;" >Booking Status</h1></p>
    <div class="ani" style="margin-bottom: 15px; padding-top: 8px">
        <div class="subanimalfrm" >
            <form method="POST" enctype="multipart/form-data"><br/>
                <span style="color: white; font-size: 20px; margin-right: 5px;">

                  <span style="font-size: 19px;"> First click on Edit, then if you want to approve tick the checkbox or if you want to disapprove untick the checkbox, then click update.</span><br/> Approved
                </span>


                <input type="checkbox" name="status" value="1" <?php echo ($bookingstatus ==1? "checked='checked'" : "");?> >

                <!--                <input type='checkbox' name='approved' value='1' value='0'  " . ($approved == 1 ? "checked='checked'" : "") . "/>-->
                <input class="btnanimal" type="submit" name="update" value="Update" style="width: 120px; height: 35px"/>

            </form>
        </div>
    </div>
    <table class='table table-dark' border='1' style='margin-left: 80px; width: 87%; ' >
        <?php
        $donarid=$_SESSION['id'];
        $qry_selectall= "SELECT b.id, b.fid, b.booking_status, f.img_name, f.food_name, f.quantity, f.description, f.Approved, ur.Name, ur.Address, ur.Provinces, ur.City, Ur.Phone, Ur.Email
                            FROM booking_table AS b 
                        INNER JOIN fooddetail_table AS f ON f.fid= b.fid
                        INNER JOIN user_table AS ur ON ur.id=b.recieverid
                        where donarid='$donarid'";
        $result = $conn->query($qry_selectall);
        if($result->num_rows > 0)
        {
            echo "
      <tr style='text-align: center'>
      <th style='width:40px; text-align: center'>Bid</th>
        <th style='width:150px;text-align: center'>Food</th>
      <th style='text-align: center'>Food_name</th>
      <th style='text-align: center'>Quantity</th>
      <th style='text-align: center'>Booked By</th>
	  <th style='width:150px;text-align: center'>Address</th>
	  <th style='text-align: center' >Contact</th>
	  <th style='width:150px;text-align: center'>Approved</th>
	   <th style='text-align: center'>Edit</th>
	</tr>";
            while($food = $result->fetch_assoc())
            {
                $approved=$food['booking_status'];

                echo "<tr>
	<td style='color: white'>" . $food['id'] . "</td>
	<td><img src='Foodimage/" . $food['img_name'] . "' height='90' width='130' /></td>
		<td style='color: white'>" . $food['food_name'] . "</td>
		<td style='color: white'>" . $food['quantity'] . "</td>
			<td style='color: white'>" . $food['Name'] . " <br/>" . $food['Email'] . "</td>
	<td style='color: white'>Province No. " .$food['Provinces'] . ", <br/> " .$food['Address'] . ", " .$food['City'] . "</td>
	<td style='color: white'>" . $food['Phone'] . "</td>
		<td>   
		 
		";


                if ($approved == 1) {
                    echo "<span style=\"background-color: green; padding: 4px 5px; width:110px;height: 25px;\">Approved</span>";
                } else {
                    echo "<span style=\"background-color: red;padding: 4px 5px; width:110px;height: 25px;\">Not Approved</span>";
                }
                echo "</td>
<td><a href='donar_bookingstatus.php?id=
		".$food['id']."' >Edit</a></td>
 
     </tr>
";

            }

        }
        else
        {
            echo "<h5 style='color: whitesmoke;'>Data not found</h5>";
        }

        echo "<table>";
        ?>
</div>
</body>
</html>