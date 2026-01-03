<?php
session_start();
if ($_SESSION['role'] !== 'Employee') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
</head>
<body>

<h2>Employee Dashboard</h2>

<ul>
    <li><a href="profile.php">👤 My Profile</a></li>
    <li><a href="attendance.php">🕒 Attendance (Check‑In / Out)</a></li>
    <li><a href="attendance_history.php">📅 Attendance History</a></li>
    <li><a href="apply_leave.php">📝 Apply Leave</a></li>
    <li><a href="leave_status.php">📊 Leave Status</a></li>
    <li><a href="salary.php">💰 Salary Slip</a></li>
    <li><a href="projects.php">📌 My Projects</a></li>
</ul>

<br>
<a href="../auth/logout.php">🚪 Logout</a>

</body>
</html>
