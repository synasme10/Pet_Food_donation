
<?php
include 'connection.php';

session_start();
if(!isset($_SESSION['acc']) || $_SESSION['type'] !="Donar")
{
header('location:login.php');
}

$food_name="";
$quantity="";
$description="";
$approved="";
//collecting data from food database
if(isset($_GET['fid'])){
    $fid=$_GET['fid'];
    $qry_selectrow = "SELECT * FROM fooddetail_table WHERE fid='$fid'";
    $result_food = $conn->query($qry_selectrow);
    $value_row= $result_food->fetch_assoc();
    $food_name=$value_row['food_name'];
    $quantity=$value_row['quantity'];
    $description=$value_row['description'];
    $approved=$value_row['Approved'];
}

//inserting food details
if(isset($_POST['register']))
{
    $uid=$_SESSION['id'];
$food_name = $_POST['food_name'];
$quantity=$_POST['quantity'];
$description = $_POST['description'];

$img = $_FILES['img']['name'];
$timg = $_FILES['img']['tmp_name'];

$qry="SELECT * FROM fooddetail_table ";
$res= $conn->query($qry);
$num= $res->num_rows+1;

$img_name="Image".$num.".jpg";

$qry_insert = "INSERT INTO fooddetail_table VALUES('','$img_name','$uid','$food_name','$quantity','$description','0')";
if($conn->query($qry_insert) == FALSE)
{
die("Errorinsert: ".$conn->error);
}
move_uploaded_file($timg,"Foodimage/".$img_name);
echo '<script>alert("Food Added for Donation successfully")</script>';
$food_name="";
$quantity="";
$description="";

}

//update food table
if(isset($_POST['update']))
{
    $fid=$_GET['fid'];
    $foodname = $_POST['food_name'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['description'];


    $qry_update = "UPDATE fooddetail_table SET food_name='$foodname',quantity='$quantity',
	   description='$desc' WHERE fid='$fid'";
    if($conn->query($qry_update) == FALSE)
    {
        die("Error: ".$conn->error);
    }
    echo '<script>alert("Updated successfully")</script>';
    header("Refresh:0; url=donar.php ");
}

//Deleting food from table if admin hasn't approved the food
if(isset($_POST['delete']))
{
    $fid=$_GET['fid'];

    $qry_delete = "DELETE from fooddetail_table WHERE fid='$fid' and Approved=0";
    if($conn->query($qry_delete) == FALSE)
    {
        die("Error: ".$conn->error);
    }
    echo '<script>alert("Deleted successfully")</script>';
    header("Refresh:0; url=donar.php ");
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

  <link type="text/css"  rel="stylesheet" href="css/all.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head
 <a name="above"></a>
<body>
  <div class="main">
	<div class="headuser">
		<div class="sub_headerone">
        <div class="logo">
             <img src="images/logo.jpg" alt="Spencer Animal Shelter logo" height="80" width="150" />
          </div>

        <div class="navbars">
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

<div class="ani">
  <div class="subanimalfrm">
    <h1> Donate Food</h1>
	<form method="POST" enctype="multipart/form-data"><br/>
<label>Food Name</label>
        <input type="text" name="food_name"  value="<?php echo $food_name;?>" placeholder="Food Name" required/><br /><br />
<label>Quantity</label>
        <input type="text" name="quantity"  value="<?php echo $quantity;?>" placeholder="Quantity" required/><br /><br />
<label>Description</label><br/><br/>
        <textarea placeholder="Description"  name="description" rows="7" cols="80" required><?php echo $description;?></textarea>
        <br/><br/>
<label>Food Image</label>
        <input type="file" name="img" /><br /><br />
<input class="btnanimal" type="submit" name="register" value="Donate Food" style="height: 30px;width: 120px"/>
<input class="btnanimal" type="submit" name="update" value="Update" style="height: 30px;width: 120px"/>
       <?php
       if ($approved==0)
      {
      echo "  <input class='btnanimal' type='submit' name='delete' value='Delete' style='height: 30px;width: 120px'>";
            }
             ?>
    </form>


</div>
</div>

      <table class='table table-dark' border='1' style='margin-left: 80px; width: 87%; ' >
          <?php
          $uid=$_SESSION['id'];
          $qry_selectall= "SELECT *
                         From fooddetail_table 
                        where uid='$uid'";
          $result = $conn->query($qry_selectall);
          if($result->num_rows > 0)
          {
              echo "
      <tr style='text-align: center'>
      <th style='width:40px; text-align: center'>Bid</th>
        <th style='width:150px;text-align: center'>Food</th>
      <th style='text-align: center'>Food Name</th>
      <th style='text-align: center'>Quantity</th>
      <th style='text-align: center'>Admin Approve</th>
	  <th style='width:150px;text-align: center'>Edit</th>
	</tr>";
              while($food = $result->fetch_assoc())
              {
                  $approved=$food['Approved'];

                  echo "<tr>
	<td style='color: white'>" . $food['fid'] . "</td>
	<td><img src='Foodimage/" . $food['img_name'] . "' height='90' width='130' /></td>
		<td style='color: white'>" . $food['food_name'] . "</td>
		<td style='color: white'>" . $food['quantity'] . "</td>
		<td>   
		 
		";


                  if ($approved == 1) {
                      echo "<span style=\"background-color: green; padding: 4px 5px; width:110px;height: 25px;\">Approved</span>";
                  } else {
                      echo "<span style=\"background-color: red;padding: 4px 5px; width:110px;height: 25px;\">Not Approved</span>";
                  }
                  echo "</td>
<td><a href='donar.php?fid=
		".$food['fid']."' >Edit</a></td>
 
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
?>

</div>
 </body>
 </html>