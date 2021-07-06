<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="UTF-8">
<title>Home</title>
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family= Open Sans;">
  <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
<link type="text/css"  rel="stylesheet" href="css/all.css">
</head>
 <a name="above"></a>
<body>
  <div class="main">
	<div class="header">
			<img src="images/photo3.jpg" alt="Recycling waste foods" height="450px" width="100%" />
		<div class="sub_header">
        <div class="logo">
             <img src="images/logo.jpg" alt="recycle logo" height="80" width="150" />
          </div>
          
        <div class="navbars">
           <ul type="none" >
               <li id="jpt"><a href="index.php" >Home</a></li>
                     <li ><a href="#contact"> CONTACT </a></li>
                       <li ><a href="login.php" >LOGIN </a></li>
                          <li ><a href="signup.php" >SIGNUP </a></li>           
      </ul>  
    </div>
    <div class='visit'>
<?php
include 'connection.php';
$qry_selcount = "SELECT counter FROM counter_table";
$result = $conn->query($qry_selcount);
$count=0;
	if($result->num_rows > 0)
	{
	while($value = $result->fetch_assoc())
	{
	$count=$value['counter'];
	if($count>0){
	$count=$count+1;
	$qry_upcount = "UPDATE counter_table SET counter = '$count'";
	if($conn->query($qry_upcount) == FALSE)
	{	
	die("Error: ".$conn->error);
	}}
	}
	}
else
{
  $count=1;
  $qry_ins = "INSERT INTO counter_table Values('','$count')";
  if($conn->query($qry_ins) == FALSE)
{
die("Errorinsert: ".$conn->error);
}
}
echo '<img src="images/visit3.png"  alt="Visitor" height="20px" width="35" />'.$count;
 ?>

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
<div class="content">
  <div class="picture_slide">    
<!-- Sliding of pictures -->
  <div class="slide">
    <img src="images/slide/1.jpg" height="350" width="550"/>
  </div>
 <div class="slide">
    <img src="images/slide/2.jpg" height="350" width="550"/>
  </div>
  <div class="slide">
    <img src="images/slide/3.jpg" height="350" width="550"/">
  </div>
 <div class="slide">
    <img src="images/slide/4.jpg" height="350" width="550"/>
  </div> 
<script>
  var slidecount = 0;
Slider();

function Slider() {
    var i;
    var slides = document.getElementsByClassName("slide");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    slidecount++;
    if (slidecount > slides.length) {slidecount = 1} 
    slides[slidecount-1].style.display = "block"; 
    setTimeout(Slider, 1500); // Image slide in 1.5 sec difference..
}
</script> 


   </div>


    <div class="content_define">
      <h1 style="font-size: 40px;">Reclying Waste Foods</h1>
         <span> Non-Profit food recovery organization with a misson to end food waste and hunger to make the "World Hunger Free" by collecting and providing the foods to needy animals. <br/> <br/>
         Restaurants, Peoples, Communities can donate leftovers to the needy people so that the people can collect the leftovers and feed to the needy animals in need of foods.</span>
    </div>
</div>
<div class="description">
    <div class="desc1" style="margin-left: 140px;" >
      <h3> Website Faciliates?</h3>
      <span>There are more than thousand animals who doesn't get enough food daily. So Your leftovers can save lifes of thousands of animals. Your Small Help can give Huge Outcomes</span>
     </div>
    <div class="desc2" style="margin-left: -20px;">
        <h3> Donate Foods?</h3>
        <span>Restaurants, or a event that you enjoy can have some leftovers. Thus you can provide the leftovers detail through the sites and the needy people, organization, NGOs can take you leftover and provide to the needy animals</span>
      </div>
  </div>
<div class="subscribe">
  <h1 id="head">JOIN US</h1>
  <h1>NEVER MISS AN UPDATE</h1>
      <form method="POST">
        <span class="sub"><input type="email" pattern="[^ @]*@[^ @]*" placeholder="Email Address"/></span><br>
        <span class="sub"><input type="submit" value="SUBSCRIBE NOW"/></span>
      </form>

</div>
<div class="footer">
   <a name="contact"></a>
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
<div><a href="#above" id="top">Back to top of page ↑</a></div>
</div>
</body>
</html>