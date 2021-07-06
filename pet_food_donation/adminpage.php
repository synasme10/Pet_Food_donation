<?php
include 'connection.php';

session_start();
if(!isset($_SESSION['acc']) || $_SESSION['type'] !="Admin")
{
    header('location:login.php');
}
$approve="";
// GET THE VALUE FROM DATABASE WITH THE HELP OF ID
if(isset($_GET['fid']))
{
    $fid=$_GET['fid'];
    $qry_selectrow = "SELECT * FROM fooddetail_table WHERE fid='$fid'";
    $result_food = $conn->query($qry_selectrow);
    $value_row= $result_food->fetch_assoc();
    $approve = $value_row['Approved'];

}


//UPDATING FOOD DETAIL
if(isset($_POST['update']))
{
    $fid=$_GET['fid'];
    $status = (isset($_REQUEST['status']));
    if ($status == 1 )
    {
        $status = 1;
    }
    else
    {
        $status = 0;
    }

    $qry_update = "UPDATE fooddetail_table SET   
	   Approved='$status' WHERE fid='$fid'";
    if($conn->query($qry_update) == FALSE)
    {
        die("Error: ".$conn->error);
    }
      header('location:adminpage.php');
    echo '<script>alert("Updated successfully")</script>';

}

//DELETING FOOD DETAIL
if(isset($_POST['delete']))
{
    $fid=$_GET['fid'];

    $qry_delete = "DELETE from fooddetail_table WHERE fid='$fid'";
    if($conn->query($qry_delete) == FALSE)
    {
        die("Error: ".$conn->error);
    }
    echo '<script>alert("Deleted successfully")</script>';
}

?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <title>food Waste Admin Page</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family= Open Sans;">
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link type="text/css"  rel="stylesheet" href="./css/form1.css">
    <link type="text/css"  rel="stylesheet" href="./css/all.css">



</head
<a name="above"></a>
<body>
<div class="main">
    <div class="headuser">
        <div class="sub_headerone">

            <div class="logo">
                <img src="images/logo.jpg" alt="Spencer Animal Shelter logo" height="80" width="100" />
            </div>

            <div class="navbars">

                <ul type="none" >
                    <li ><a href="adminpage.php" >FOOD DETAIL</a></li>
                    <li ><a href="#" >
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

    <div class="ani" style="margin-bottom: 15px; padding-top: 8px">
        <div class="subanimalfrm" >
            <h1 style='color: white;'>Food Detail</h1>
            <span style="color:white; font-size: 19px;"> First click on Edit, then if you want to approve tick the checkbox or if you want to disapprove untick the checkbox, then click update.</span><br/>

            <form method="POST" enctype="multipart/form-data">
                <span style="color: white; margin-right: 5px; font-size: 20px;">
                    Approved
                </span>


                <input type="checkbox" name="status" value="1" <?php echo ($approve ==1? "checked='checked'" : "");?> >

<!--                <input type='checkbox' name='approved' value='1' value='0'  " . ($approved == 1 ? "checked='checked'" : "") . "/>-->
                <input class="btnanimal" type="submit" name="update" value="Update" style="width: 120px; height: 35px"/>

            </form>
        </div>
    </div>
    <div class="dessertdesign">
        <?php
        $qry_selectall = "SELECT *
        FROM fooddetail_table As f 
        INNER JOIN user_table AS ur ON f.uid= ur.id";

        $result = $conn->query($qry_selectall);
        if($result->num_rows > 0)
        {
            echo "
<table class='table table-dark' border='1' style='margin-left: 80px; width: 87%; ' >
      <tr style='text-align: center'>
      <th style='text-align: center;width: 40px;'>Fid</th>
       <th style='width:150px;text-align: center'>Food</th>
      <th style='text-align: center'>Name</th>
      <th style='text-align: center'>Quantity</th>
      <th style='width:180px;text-align: center '>Description</th>
      <th style='text-align: center;width: 170px;'>Donar Name</th>
	  <th style='text-align: center;width: 200px;'>Address</th>
	  <th style='text-align: center'>Contact</th>
	  <th style='width:150px;text-align: center'>Approved</th>
	  <th style='text-align: center'>Edit</th></tr>";
            while($food = $result->fetch_assoc())
            { $approved=$food['Approved'];
                echo "<tr>
		<td style='color: white'>".$food['fid']."</td>
		<td><img src='Foodimage/".$food['img_name']."
		' height='90' width='130' /></td>
		<td style='color: white'>".$food['food_name']."</td>
		<td style='color: white'>".$food['quantity']."</td>
		<td style='color: white'>".$food['description']."</td>s
		<td style='color: white'>".$food['Name']."<br/>".$food['Email']."</td>
	<td style='color: white'>Province No. " .$food['Provinces'] . ", <br/> " .$food['Address'] . ", " .$food['City'] . "</td>
    <td style='color: white'>".$food['Phone']."</td>
		
		
		<td>       
		
		";if ($approved==1){ echo "<span style=\"background-color: green; padding: 2px 2px; width:110px;height: 25px;\">Approved</span>";}
            else{ echo "<span style=\"background-color: red;padding: 2px 2px;width:110px;height: 25px;\">Not Approved</span>";}
                echo"</td>
	
		</form>
		<td><a href='adminpage.php?fid=
		".$food['fid']."' >Edit</a></td>
		
     </tr>";

            }
            echo "<table>";
        }
        else
        {
            echo "Data not found";
        }
        ?>

    </div>
</div>

</body>
</html>