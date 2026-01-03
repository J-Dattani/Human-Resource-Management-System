<?php
session_start();
if($_SESSION['role'] !== 'Admin'){
    header("Location: ../login.php");
    exit;
}

include("../config/db.php");

$employees = mysqli_query($conn,"
    SELECT e.emp_id, e.emp_code, e.first_name, e.last_name,
           e.department, e.designation, u.email
    FROM employees e
    JOIN users u ON e.user_id = u.user_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employees</title>
</head>
<body>

<h2>Employee List</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Emp Code</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Designation</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($employees)) { ?>
    <tr>
        <td><?= $row['emp_code'] ?></td>
        <td><?= $row['first_name']." ".$row['last_name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['department'] ?></td>
        <td><?= $row['designation'] ?></td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
