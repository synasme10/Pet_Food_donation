<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['acc'] ))
{
    header('location:login.php');
}

if(isset($_POST['ask']))
{
    $name=$_SESSION['name'];
    $question=$_POST['question'];
    $qry_ask = "INSERT INTO question_table VALUES ('','$question','$name')";
    if($conn->query($qry_ask)==FALSE)
    {
        die("Error: ".$conn->error);
    }
    echo '<script>alert("Question Asked successfully")</script>';
}

/*Deleting into answer table */
if(isset($_GET['answerid']))
{
    $userid=$_SESSION['id'];
    $ansid = $_GET['answerid'];
    $qry_del = "DELETE FROM answer_table WHERE aid='$ansid' and userid='$userid' ";
    if($conn->query($qry_del)==TRUE)
    {
        echo '<script>alert("Deleted successfully")</script>';
    }
}

/*Inserting into answer table */
if(isset($_POST['ans']))
{
    $userids=$_SESSION['id'];
    $questionid=$_POST['id'];
    $answer=$_POST['answer'];
    $name=$_SESSION['name'];
    $qry_ask = "INSERT INTO answer_table VALUES ('','$answer','$questionid','$name','$userids')";
    if($conn->query($qry_ask)==FALSE)
    {
        die("Error: ".$conn->error);
    }
    echo '<script>alert("Answered")</script>';
}


?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UT=F-8">
    <title>FORUM</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family= Open Sans;">
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link type="text/css"  rel="stylesheet" href="css/all.css">
    <link type="text/css"  rel="stylesheet" href="css/forum.css">
</head>
<a name="above"></a>
<body class="bf">
<div class="main">
    <div class="headuser">
        <div class="sub_headerone">
            <div class="logo">
                <img src="images/logo.jpg" alt="recycle waste logo" height="80" width="150" />
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



    <div class="ask">
        <div class="subask" >
            <h1>Ask Question</h1>
            <form method="POST">
                <textarea placeholder="Ask Question" name="question" rows="7" cols="70" required></textarea>
                <input type="submit" id="submitques" name="ask" value="POST QUESTION"> <br/> <br/>
            </form>
        </div>
        <div class="toys" style="padding-top: 50px">
            <div class="slide">
                <img src="images/foodslide/food1.png" height="250px" width="70%"/>
            </div>
            <div class="slide">
                <img src="images/foodslide/food2.png" height="250px" width="70%"/>
            </div>
            <div class="slide">
                <img src="images/foodslide/food3.png" height="250px" width="70%"/>
            </div>
            <div class="slide">
                <img src="images/foodslide/food4.png" height="250px" width="70%"/">
            </div>
            <div class="slide">
                <img src="images/foodslide/food5.png" height="250px" width="70%"/>
            </div>
            <div class="slide">
                <img src="images/foodslide/food6.jpg" height="250px" width="70%"/>
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
                    setTimeout(Slider, 2000); // Image slide in 2 sec difference..
                }
            </script>


        </div>
    </div>
    <div class="question">
        <?php
        $begin=0;
        $maximum=2;
        $qry_ques="select * from question_table ";
        $result=$conn->query($qry_ques);
        $total=$result->num_rows;
        $pages=ceil($total/$maximum);
        if(isset($_GET['pages']))
        {
            $begin=($_GET['pages']-1)*$maximum;
        }
        $select_ques="SELECT * FROM question_table LIMIT $begin,$maximum";
        $result_ques=$conn->query($select_ques);
        while ($data=$result_ques->fetch_assoc())
        {
            $qid=$data['qid'];
            $ques=$data['Question'];
            $names=$data['Username'];

            echo "<p><b><span style='margin: 0 5px; color:#F1A9A0;'>".$qid.".</span> 
	  <span style='font-size:25px; color:#F1A9A0;'>".$ques." </span>
      <span style='color: #4ECDC4; float:right;margin-right:7em;'>
      <span style='background-color:grey;color:white;'>
	  Question By:</span> ".$names."</span><b></p>
    <form method='post'>
	<input type='text' value='$data[qid]' name='id' hidden>
	<textarea rows='6' cols='150' name='answer' placeholder='Answer Here'></textarea>
	<br><input type='submit' name='ans' value='ANSWER'/> <br/>
	</form>";

            $qry_sel = "SELECT * FROM answer_table WHERE qids='$data[qid]'";
            $result_ans=$conn->query($qry_sel);
            while($data_ans=$result_ans->fetch_assoc())
            {
                $ansid=$data_ans['aid'];
                $answer=$data_ans['Answer'];
                $answerby=$data_ans['Answerby'];
                echo "<div class='answer'>
	   <div class='ansdec'> Ans.<div class='anscontent'>".$answer."</div>
       <span ><div class='ansby'><span style='background-color:grey;color:white;'>
	   Answer By</span> ".$answerby."</span> <br>  <br>              
     <a href='forum.php?answerid=$ansid'>Delete</a></div></div></div>";
            }
        }
        ?>
    </div>
    <div class="pagination">
        <?php
        for($p=1;$p<=$pages;$p++)
        {
            echo "<a href='forum.php?pages=".$p."'>$p</a> ";
        }
        ?>
    </div>
    <div class="footer">
        <a name="contact"></a>
        <h2>Contact Us</h2>
        <div class="ephone">
            <div class="ephone1"><img src="images/phone.png" alt="GKClogo" height="60" width="60"/></div>
            <div class="ephone2"><img src="images/Email.png" alt="GKClogo" height="60" width="60"/></div>
        </div>
        <div class="info">
            Reclying Waste Foods,  Nepal<br><br>
            +977-1-423 2455, 224 8511 <br><br>
            Email : reclyclefood10@gmail.com
        </div>


        <div class="copyright">
            <p style="margin-left: -100px">©2021 COPYRIGHT RWF, All Rights Reserved & Privacy Terms</p>
        </div>


    </div>
    <div><a href="#above" id="top">Back to top of page ↑</a></div>
</div>
</body>
</html>