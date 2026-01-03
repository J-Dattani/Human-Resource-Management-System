<?php
session_start();
if ($_SESSION['role'] !== 'Admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>

<ul>
    <li><a href="add_employee.php">➕ Add Employee</a></li>
    <li><a href="view_employees.php">👥 View Employees</a></li>
    <li><a href="leave_requests.php">📝 Leave Requests</a></li>
    <li><a href="attendance_report.php">🕒 Attendance Report</a></li>
    <li><a href="salary.php">💰 Salary Management</a></li>
    <li><a href="projects.php">📌 Projects</a></li>
</ul>

<br>
<a href="../auth/logout.php">🚪 Logout</a>

</body>
</html>
