<?php
session_start();
include("../config/db.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT u.user_id, r.role_name, e.emp_id
        FROM users u
        JOIN roles r ON u.role_id = r.role_id
        LEFT JOIN employees e ON u.user_id = e.user_id
        WHERE u.email='$email' AND u.password='$password'";

$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) == 1){
    $row = mysqli_fetch_assoc($res);
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['emp_id']  = $row['emp_id'];
    $_SESSION['role']    = $row['role_name'];
    echo $row['role_name']; // Admin / Employee
}else{
    echo "invalid";
}
?>
