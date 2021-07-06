
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
   <title>User Home</title>
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
           <div class="logo" style="margin-left: -7px;">
               <img src="images/logo.jpg" alt="Spencer Animal Shelter logo" height="80" width="150" />
           </div>

           <div class="navbars">
               <ul type="none">
                   <li style="margin-left: -10px;">
                       <div class="input-group" style="margin-top: 23px; ">
                           <div class="form-outline">
                               <form action="searchName.php" method="get" role="form">
                                   <input type="text" name="name" class="form-control" placeholder="Search" size="12" />

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

    <p style="margin-left: 370px; "><h1 style="color: white; margin-bottom: -28px">Donated Food</h1></p>
    <div class="animals_box">
        <?php
        include 'connection.php';

        //selecting all data from a table
        $qry_sel = "SELECT * 
          FROM fooddetail_table As f 
        INNER JOIN user_table AS ur ON f.uid= ur.id
        WHERE f.Approved='1'";
        $result = $conn->query($qry_sel);
        if($result->num_rows > 0)
        {
            while($food = $result->fetch_assoc())
            {

                echo "<div class='boxinside' style='height: 560px; margin-right: 25px; margin-left: 50px' >
		<img src='Foodimage/".$food['img_name']."'
		 height='180' width='250' style='margin:5px 30px; margin-bottom: 10px' />
		<p><b style='color: #ffffff; padding-left: 4px; padding-right: 55px '>".$food['food_name']."</b></p>
<p style='padding-right: 5px;'><b>About </b> <span>".$food['quantity']."</span> Plates</p>
		<p style='text-align: left; padding-left: 37px'><b style='margin-left: 1px;'>Description: </b><br/> <span>".$food['description']."</span></p>
		<p ><b>Address: </b> Province No. " .$food['Provinces'] . ", <br/> 
		<span style='margin-right: 38px;'> " .$food['Address'] . ", " .$food['City'] . "</span></p>
	    <p style='margin-bottom: 25px;'><b>Post By: </b> ".$food['Name']."</p>";

                $fid=$food['fid'];
                $qry_checkbooking="SELECT * From booking_table WHERE fid='$fid'";
                $resultbook= $conn->query($qry_checkbooking);
                if($resultbook->num_rows==0)
                {
                    echo	"<p style='margin-left: 98px;'><button type='button' class='btn btn-primary btn-sm'><a style='color: white;font-size:15px; ' href='booking.php?fid=
				".$food['fid']."& donarid=".$food['uid']."'>Reserve Food</a></button></p>";
                }
                else
                {
                    echo "<p style='margin-left: 67px;'><b style='font-size:18px; color:aqua;'><button type='button' class='btn btn-danger btn-sm' disabled>Already Taken</button></b></p>";
                }

//                echo "<br/><p style='alignment: center; padding-left: 20px;'><button type='button' class='btn btn-primary btn-sm'><a style='color: white;font-size:15px; 'href='single_food.php?ids= ".$food['fid']."'>View Detail</a></button></p>";
                echo "</div>";

            }
        }
        else
        {
            echo "<span style='color: white; margin-top: 70px;' > No data found</span>";
        }
        ?>
    </div>


</div>
</body>
</html>