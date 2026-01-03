<?php
include("../config/db.php");

$email=$_POST['email'];
$password=$_POST['password'];

$emp_code=$_POST['emp_code'];
$first=$_POST['first_name'];
$last=$_POST['last_name'];
$dept=$_POST['department'];
$desg=$_POST['designation'];
$join=$_POST['join_date'];

mysqli_query($conn,"INSERT INTO users (role_id,email,password) VALUES (2,'$email','$password')");
$user_id=mysqli_insert_id($conn);

mysqli_query($conn,"INSERT INTO employees 
(user_id,emp_code,first_name,last_name,department,designation,join_date)
VALUES ($user_id,'$emp_code','$first','$last','$dept','$desg','$join')");

echo "success";
?>
