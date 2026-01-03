<?php
session_start();
if ($_SESSION['role'] !== 'Admin') {
    header("Location: ../login.php");
    exit;
}
include("../config/db.php");

$res = mysqli_query($conn,"
    SELECT e.emp_code, e.first_name, e.last_name,
           a.date, a.check_in, a.status
    FROM attendance a
    JOIN employees e ON a.emp_id = e.emp_id
    ORDER BY a.date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
</head>
<body>

<h2>Attendance Report</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Emp Code</th>
    <th>Name</th>
    <th>Date</th>
    <th>Check In</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($res)) { ?>
<tr>
    <td><?= $row['emp_code'] ?></td>
    <td><?= $row['first_name']." ".$row['last_name'] ?></td>
    <td><?= $row['date'] ?></td>
    <td><?= $row['check_in'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>

<a href="dashboard.php">Back</a>

</body>
</html>
