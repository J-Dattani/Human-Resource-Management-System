<?php
session_start();
if($_SESSION['role'] !== 'Admin'){
    header("Location: ../login.php");
    exit;
}
include("../config/db.php");

if(isset($_POST['leave_id'])){
    $id = $_POST['leave_id'];
    $status = $_POST['status'];
    mysqli_query($conn,"UPDATE leave_requests SET status='$status' WHERE leave_id=$id");
}

$leaves = mysqli_query($conn,"
    SELECT l.leave_id, e.first_name, e.last_name,
           l.from_date, l.to_date, l.status
    FROM leave_requests l
    JOIN employees e ON l.emp_id = e.emp_id
    ORDER BY l.applied_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Requests</title>
</head>
<body>

<h2>Leave Requests</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Employee</th>
    <th>From</th>
    <th>To</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($leaves)) { ?>
<tr>
    <td><?= $row['first_name']." ".$row['last_name'] ?></td>
    <td><?= $row['from_date'] ?></td>
    <td><?= $row['to_date'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <form method="POST" style="display:inline">
            <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
            <input type="hidden" name="status" value="Approved">
            <button>Approve</button>
        </form>
        <form method="POST" style="display:inline">
            <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
            <input type="hidden" name="status" value="Rejected">
            <button>Reject</button>
        </form>
    </td>
</tr>
<?php } ?>

</table>

<a href="dashboard.php">Back</a>

</body>
</html>
