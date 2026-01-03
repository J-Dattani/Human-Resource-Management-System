<?php
session_start();
if($_SESSION['role'] !== 'Employee'){
    header("Location: ../login.php");
    exit;
}
include("../config/db.php");

$emp_id = $_SESSION['emp_id'];
$res = mysqli_query($conn,"
    SELECT * FROM leave_requests
    WHERE emp_id = $emp_id
    ORDER BY applied_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Leave Status</title>
</head>
<body>

<h2>My Leave Requests</h2>

<table border="1" cellpadding="8">
<tr>
    <th>From</th>
    <th>To</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($res)) { ?>
<tr>
    <td><?= $row['from_date'] ?></td>
    <td><?= $row['to_date'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>

<a href="dashboard.php">Back</a>

</body>
</html>
