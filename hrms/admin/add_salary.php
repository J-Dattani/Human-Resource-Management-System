<?php
include("../config/db.php");

$emp_id = $_POST['emp_id'];
$basic = $_POST['basic'];
$hra = $_POST['hra'];
$allowance = $_POST['allowance'];
$deduction = $_POST['deduction'];
$month = $_POST['month'];
$year = $_POST['year'];

$total = $basic + $hra + $allowance - $deduction;

mysqli_query($conn,
"INSERT INTO salary
(emp_id, basic, hra, allowance, deduction, total_salary, month, year)
VALUES
($emp_id, $basic, $hra, $allowance, $deduction, $total, '$month', $year)");

echo "salary_added";
?>
