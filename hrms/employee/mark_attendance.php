<?php
session_start();
include("../config/db.php");

$emp_id=$_SESSION['emp_id'];
$date=date("Y-m-d");
$time=date("H:i:s");

mysqli_query($conn,"INSERT INTO attendance (emp_id,date,check_in)
VALUES ($emp_id,'$date','$time')");

echo "attendance_marked";
?>
