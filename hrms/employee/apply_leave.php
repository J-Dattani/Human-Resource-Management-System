<?php
session_start();
if($_SESSION['role'] !== 'Employee'){
    header("Location: ../login.php");
    exit;
}
include("../config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Leave</title>
</head>
<body>

<h2>Apply Leave</h2>

<form method="POST">
    Leave Type ID:<br>
    <input type="number" name="leave_type_id" required><br><br>

    From Date:<br>
    <input type="date" name="from_date" required><br><br>

    To Date:<br>
    <input type="date" name="to_date" required><br><br>

    Reason:<br>
    <textarea name="reason" required></textarea><br><br>

    <button type="submit">Apply</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $emp_id = $_SESSION['emp_id'];
    $type = $_POST['leave_type_id'];
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    $reason = $_POST['reason'];

    mysqli_query($conn,"INSERT INTO leave_requests
    (emp_id, leave_type_id, from_date, to_date, reason)
    VALUES ($emp_id, $type, '$from', '$to', '$reason')");

    echo "<p style='color:green'>Leave Applied Successfully</p>";
}
?>

<a href="dashboard.php">Back</a>

</body>
</html>
