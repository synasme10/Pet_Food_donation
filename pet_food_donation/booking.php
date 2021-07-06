<?php
include 'connection.php';

session_start();
if (isset($_GET['fid']));
{
    $fid=$_GET['fid'];
    $donarid=$_GET['donarid'];
    $userid=$_SESSION['id'];



    $qry_insbook="INSERT into booking_table VALUES('','$fid','$donarid','$userid','')";
    if($conn->query($qry_insbook) == FALSE)
    {
        die("Error: ".$conn->error);
    }
    else
    {
        echo '<script>Food Reserved Successfully</script>';
    }
    header("location:food_dashboard.php");
}
?>