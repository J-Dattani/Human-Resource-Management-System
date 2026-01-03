<?php
$conn = mysqli_connect("localhost", "root", "", "HRMS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>