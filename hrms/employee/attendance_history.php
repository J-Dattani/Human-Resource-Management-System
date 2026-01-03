<?php
session_start();
if ($_SESSION['role'] !== 'Employee') {
    header("Location: ../login.php");
    exit;
}
include("../config/db.php");

$emp_id = $_SESSION['emp_id'];

$res = mysqli_query($conn,
    "SELECT * FROM attendance WHERE emp_id=$emp_id ORDER BY date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance History</title>
</head>
<body>

<h2>My Attendance</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Date</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th></th>Status</th>
</tr>


<?php while($row = mysqli_fetch_assoc($res)) { ?>
<tr>
    <td><?= $row['date'] ?></td>
    <td><?= $row['check_in'] ?></td>
    <td><?= $row['check_out'] ?? '-' ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>

<a href="dashboard.php">Back</a>

</body>
</html>
