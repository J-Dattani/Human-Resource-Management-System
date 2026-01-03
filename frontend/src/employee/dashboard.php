<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Employee') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
// Fetch Employee Info
$empQ = mysqli_query($conn, "SELECT emp_id, first_name FROM employees WHERE user_id='$user_id'");
$emp = mysqli_fetch_assoc($empQ);
$firstName = $emp['first_name'] ?? 'Employee';
$emp_id = $emp['emp_id'];

// Calculate Leave Balance (assuming 20 days annual, minus approved leaves)
$annualLeave = 20;
$usedLeaveQ = mysqli_query($conn, "SELECT SUM(DATEDIFF(to_date, from_date) + 1) as used FROM leave_requests WHERE emp_id='$emp_id' AND status='Approved' AND YEAR(from_date)=YEAR(CURDATE())");
$usedLeave = mysqli_fetch_assoc($usedLeaveQ)['used'] ?? 0;
$leaveBalance = max(0, $annualLeave - $usedLeave);

// Fetch Last Salary
$lastSalaryQ = mysqli_query($conn, "SELECT net_salary, payment_date, month, status FROM payroll_history WHERE emp_id='$emp_id' ORDER BY payment_date DESC LIMIT 1");
$lastSalary = mysqli_fetch_assoc($lastSalaryQ);
$lastSalaryAmount = $lastSalary ? number_format($lastSalary['net_salary'], 0) : '0';
$lastSalaryStatus = $lastSalary ? $lastSalary['status'] : 'N/A';
$lastSalaryMonth = $lastSalary ? date('F Y', strtotime($lastSalary['month'] . '-01')) : 'N/A';

// Fetch Today's Status
$today = date('Y-m-d');
$attQ = mysqli_query($conn, "SELECT attendance_id, status FROM attendance WHERE emp_id='$emp_id' AND date='$today'");
$todayStatus = "Not Checked In";
$checkInTime = "-";
$btnText = "Check In";
$btnAction = "punch_in"; // Param for mark_attendance.php

if (mysqli_num_rows($attQ) > 0) {
    $att = mysqli_fetch_assoc($attQ);
    $att_id = $att['attendance_id'];
    $todayStatus = "Checked In";

    // Get First IN
    $inQ = mysqli_query($conn, "SELECT log_time FROM attendance_logs WHERE attendance_id='$att_id' AND log_type='IN' ORDER BY log_id ASC LIMIT 1");
    if (mysqli_num_rows($inQ) > 0) {
        $checkInTime = date('h:i A', strtotime(mysqli_fetch_assoc($inQ)['log_time']));
    }

    // Check Last Log for Button State
    $lastLogQ = mysqli_query($conn, "SELECT log_type FROM attendance_logs WHERE attendance_id='$att_id' ORDER BY log_id DESC LIMIT 1");
    $lastLog = mysqli_fetch_assoc($lastLogQ);
    if ($lastLog['log_type'] == 'IN') {
        $btnText = "Check Out";
        $btnAction = "punch_out"; // This needs to be handled by mark_attendance.php form, 
        // but dashboard button just links there. 
    } else {
        $todayStatus = "Checked Out";
        $btnText = "View Attendance";
    }
}
?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar_employee.php'; ?>
        <main class="dashboard-main">
            <?php include '../includes/header_employee.php'; ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">

                <h2 class="h4 mb-4">Good Morning, <?php echo htmlspecialchars($firstName); ?> ☀️</h2>

                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <!-- Attendance Status Card (Check In/Out) -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0 bg-blue-light h-100">
                            <div class="d-flex flex-column h-100 justify-content-between">
                                <div>
                                    <div class="stat-label text-primary mb-1">Today's Status</div>
                                    <div class="stat-value text-primary"><?php echo $checkInTime; ?></div>
                                    <span class="badge bg-white text-primary mt-2"><?php echo $todayStatus; ?></span>
                                </div>
                                <a href="mark_attendance.php"
                                    class="btn btn-primary w-100 mt-3 btn-sm"><?php echo $btnText; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-green-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-blue-light text-primary"><?php echo $leaveBalance; ?> Left</span>
                            </div>
                            <div>
                                <div class="stat-value">Available</div>
                                <div class="stat-label">Leave Balance</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-purple-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-green-light text-success"><?php echo $lastSalaryStatus; ?></span>
                            </div>
                            <div>
                                <div class="stat-value">₹<?php echo $lastSalaryAmount; ?></div>
                                <div class="stat-label">Last Salary</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Recent Activity & Calendar -->
                <div class="row g-3 mb-4">
                    <!-- Activity Log -->
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header pb-0 border-0">
                                <h3 class="card-title">Recent Attendance</h3>
                                <a href="mark_attendance.php" class="btn btn-light btn-sm">View All</a>
                            </div>
                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="modern-table">
                                        <thead>
                                            <tr>
                                                <th class="ps-3">Date</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $recentQ = mysqli_query($conn, "SELECT * FROM attendance WHERE emp_id='$emp_id' ORDER BY date DESC LIMIT 3");
                                            while ($row = mysqli_fetch_assoc($recentQ)):
                                                $aid = $row['attendance_id'];
                                                $inTime = '-';
                                                $outTime = '-';
                                                // Fetch Times
                                                $logQ = mysqli_query($conn, "SELECT log_type, log_time FROM attendance_logs WHERE attendance_id='$aid'");
                                                while ($l = mysqli_fetch_assoc($logQ)) {
                                                    if ($l['log_type'] == 'IN' && $inTime == '-')
                                                        $inTime = date('h:i A', strtotime($l['log_time']));
                                                    if ($l['log_type'] == 'OUT')
                                                        $outTime = date('h:i A', strtotime($l['log_time']));
                                                }
                                                ?>
                                                <tr>
                                                    <td class="ps-3 fw-medium">
                                                        <?php echo date('M d', strtotime($row['date'])); ?></td>
                                                    <td><?php echo $inTime; ?></td>
                                                    <td><?php echo $outTime; ?></td>
                                                    <td><span
                                                            class="badge badge-pill bg-green-light text-success"><?php echo $row['status']; ?></span>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payslip Widget -->
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title">Latest Payslip</h3>
                            </div>
                            <div class="card-body">
                                <?php if ($lastSalary): ?>
                                <div
                                    class="p-3 bg-light rounded-3 mb-3 border d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-medium text-dark mb-1"><?php echo $lastSalaryMonth; ?></div>
                                        <div class="small text-muted">₹<?php echo $lastSalaryAmount; ?> • <?php echo $lastSalaryStatus; ?></div>
                                    </div>
                                    <div class="stat-icon bg-white border mb-0" style="width: 32px; height: 32px;">
                                        ⬇
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="p-3 bg-light rounded-3 mb-3 border text-center text-muted">
                                    No payslips available yet.
                                </div>
                                <?php endif; ?>
                                <a href="payroll.php" class="btn btn-outline-primary w-100 btn-sm">View History</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    <?php include '../includes/footer.php'; ?>