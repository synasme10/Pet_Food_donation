<?php
include 'connection.php';
$acc = $_GET['value'];
$qry = "SELECT * FROM user_table WHERE Account='$acc'";
$res = $conn->query($qry);
//echo $res->num_rows;
if($res->num_rows > 0)
{
    echo "<span style='color:red'>Not available!</span>";
}
else {
    echo "<span style='color:green;'> Available!</span>";
}
?>