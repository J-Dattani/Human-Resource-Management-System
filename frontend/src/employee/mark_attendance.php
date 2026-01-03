<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Employee') {
    header("Location: ../auth/login.php");
    exit();
}

$emp_id = $_SESSION['emp_id'];
$today = date('Y-m-d');
$message = "";
$error = "";

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $time = date('H:i:s');

    // Check existing attendance for today
    $checkAtt = mysqli_query($conn, "SELECT attendance_id FROM attendance WHERE emp_id='$emp_id' AND date='$today'");

    if (isset($_POST['punch_in'])) {
        if (mysqli_num_rows($checkAtt) == 0) {
            // First punch in (Create Attendance + Log)
            mysqli_query($conn, "INSERT INTO attendance (emp_id, date, status) VALUES ('$emp_id', '$today', 'Present')");
            $att_id = mysqli_insert_id($conn);
            mysqli_query($conn, "INSERT INTO attendance_logs (attendance_id, log_type, log_time) VALUES ('$att_id', 'IN', '$time')");
            $message = "Checked In Successfully at $time";
        } else {
            // Subsequent Punch In (e.g. after lunch break)
            $attRow = mysqli_fetch_assoc($checkAtt);
            $att_id = $attRow['attendance_id'];
            // Verify last log wasn't IN
            $lastLogQ = mysqli_query($conn, "SELECT log_type FROM attendance_logs WHERE attendance_id='$att_id' ORDER BY log_id DESC LIMIT 1");
            $lastLog = mysqli_fetch_assoc($lastLogQ);

            if ($lastLog['log_type'] == 'OUT') {
                mysqli_query($conn, "INSERT INTO attendance_logs (attendance_id, log_type, log_time) VALUES ('$att_id', 'IN', '$time')");
                $message = "Checked In Again at $time";
            } else {
                $error = "You are already Checked In!";
            }
        }
    } elseif (isset($_POST['punch_out'])) {
        if (mysqli_num_rows($checkAtt) > 0) {
            $attRow = mysqli_fetch_assoc($checkAtt);
            $att_id = $attRow['attendance_id'];

            // Verify last log was IN
            $lastLogQ = mysqli_query($conn, "SELECT log_type FROM attendance_logs WHERE attendance_id='$att_id' ORDER BY log_id DESC LIMIT 1");
            $lastLog = mysqli_fetch_assoc($lastLogQ);

            if ($lastLog['log_type'] == 'IN') {
                mysqli_query($conn, "INSERT INTO attendance_logs (attendance_id, log_type, log_time) VALUES ('$att_id', 'OUT', '$time')");
                // TODO: Calculate Total Hours
                $message = "Checked Out Successfully at $time";
            } else {
                $error = "You are already Checked Out!";
            }
        } else {
            $error = "You haven't checked in yet!";
        }
    }
}

// Fetch Stats (Current Month)
$currentMonth = date('m');
$currentYear = date('Y');
$daysInMonth = date('t');
// Present Days
$presentQ = mysqli_query($conn, "SELECT COUNT(*) as count FROM attendance WHERE emp_id='$emp_id' AND MONTH(date)='$currentMonth' AND status='Present'");
$presentCount = mysqli_fetch_assoc($presentQ)['count'];
// Leave Days (From leave_requests approved or derived?)
// Assuming leave_requests table has 'Approved' status
$leaveQ = mysqli_query($conn, "SELECT SUM(DATEDIFF(to_date, from_date) + 1) as days FROM leave_requests WHERE emp_id='$emp_id' AND status='Approved' AND MONTH(from_date)='$currentMonth'");
$leaveCount = mysqli_fetch_assoc($leaveQ)['days'] ?? 0;
// Working Days (Just days passed excluding weekends? Simple approximation: Just days passed)
$workingDays = $daysInMonth; // Simplified for UI

// Determine Button State
$btnState = 'IN'; // Enable IN, Disable OUT
$checkAttState = mysqli_query($conn, "SELECT attendance_id FROM attendance WHERE emp_id='$emp_id' AND date='$today'");
if (mysqli_num_rows($checkAttState) > 0) {
    $attRowState = mysqli_fetch_assoc($checkAttState);
    $attIdState = $attRowState['attendance_id'];
    $lastLogStateQ = mysqli_query($conn, "SELECT log_type FROM attendance_logs WHERE attendance_id='$attIdState' ORDER BY log_id DESC LIMIT 1");
    if (mysqli_num_rows($lastLogStateQ) > 0) {
        $lastLogState = mysqli_fetch_assoc($lastLogStateQ);
        if ($lastLogState['log_type'] == 'IN') {
            $btnState = 'OUT'; // Disable IN, Enable OUT
        }
    }
}
?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar_employee.php'; ?>
        <main class="dashboard-main">
            <?php include '../includes/header_employee.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-1">Attendance</h1>
                        <p class="text-muted">Track your daily work hours.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <span class="badge bg-light text-dark border p-2 fw-normal">Current Time: <span class="fw-bold"
                                id="clock">10:30 AM</span></span>
                    </div>
                </div>

                <!-- Stats Toolbar (Date Nav + Stats) -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-2">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            <!-- Date Control -->
                            <div class="d-flex align-items-center gap-2 p-2">
                                <button class="btn btn-sm btn-light border"><i
                                        class="bi bi-chevron-left">&lt;</i></button>
                                <span class="fw-bold text-dark mx-2"><?php echo date('M Y'); ?></span>
                                <button class="btn btn-sm btn-light border"><i
                                        class="bi bi-chevron-right">&gt;</i></button>
                            </div>

                            <div class="vr d-none d-md-block my-2"></div>

                            <!-- Stats Items -->
                            <div
                                class="d-flex flex-wrap gap-4 p-2 flex-grow-1 justify-content-around justify-content-md-end">
                                <div class="text-center text-md-end">
                                    <div class="small text-muted text-uppercase ls-1" style="font-size: 0.7rem;">Present
                                    </div>
                                    <div class="h5 fw-bold text-success mb-0"><?php echo $presentCount; ?> <span
                                            class="small text-muted fw-normal">days</span></div>
                                </div>
                                <div class="text-center text-md-end">
                                    <div class="small text-muted text-uppercase ls-1" style="font-size: 0.7rem;">Leaves
                                    </div>
                                    <div class="h5 fw-bold text-warning mb-0"><?php echo $leaveCount; ?> <span
                                            class="small text-muted fw-normal">days</span></div>
                                </div>
                                <div class="text-center text-md-end">
                                    <div class="small text-muted text-uppercase ls-1" style="font-size: 0.7rem;">Working
                                    </div>
                                    <div class="h5 fw-bold text-dark mb-0"><?php echo $workingDays; ?> <span
                                            class="small text-muted fw-normal">days</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">

                    <!-- Left Column: Actions & Calendar -->
                    <div class="col-12 col-lg-5 order-lg-2">
                        <!-- Check-In/Out Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4 text-center">
                                <h4 class="fw-bold mb-1">Today, <?php echo date('M d'); ?></h4>
                                <p class="text-muted small mb-4" id="realtime-clock"><?php echo date('h:i:s A'); ?></p>

                                <?php if ($message): ?>
                                    <div class="alert alert-success py-2 small mb-3"><?php echo $message; ?></div>
                                <?php endif; ?>
                                <?php if ($error): ?>
                                    <div class="alert alert-danger py-2 small mb-3"><?php echo $error; ?></div>
                                <?php endif; ?>

                                <form action="" method="POST">
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <button type="submit" name="punch_in"
                                                class="btn btn-success w-100 py-3 fw-bold shadow-sm d-flex flex-column align-items-center gap-1"
                                                <?php echo ($btnState == 'OUT') ? 'disabled' : ''; ?>>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-box-arrow-in-right"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                                    <path fill-rule="evenodd"
                                                        d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                                </svg>
                                                PUNCH IN
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="punch_out"
                                                class="btn btn-outline-danger w-100 py-3 fw-bold opacity-50 d-flex flex-column align-items-center gap-1"
                                                <?php echo ($btnState == 'IN') ? 'disabled' : ''; ?>>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-box-arrow-right"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                                    <path fill-rule="evenodd"
                                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                                </svg>
                                                PUNCH OUT
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    Creating data for: <span class="fw-bold"><?php echo date('d M Y'); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Visual Calendar Grid -->
                        <div class="card border-0 shadow-sm">
                            <div
                                class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold"><?php echo date('F Y'); ?></h6>
                                <div class="d-flex align-items-center gap-1">
                                    <button class="btn btn-sm btn-light btn-icon border rounded-circle"><i
                                            class="bi bi-chevron-left">&lt;</i></button>
                                    <button class="btn btn-sm btn-light btn-icon border rounded-circle"><i
                                            class="bi bi-chevron-right">&gt;</i></button>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <!-- Days Header -->
                                <div class="d-grid text-center mb-2"
                                    style="grid-template-columns: repeat(7, 1fr); gap: 4px;">
                                    <small class="text-muted fw-bold">S</small>
                                    <small class="text-muted fw-bold">M</small>
                                    <small class="text-muted fw-bold">T</small>
                                    <small class="text-muted fw-bold">W</small>
                                    <small class="text-muted fw-bold">T</small>
                                    <small class="text-muted fw-bold">F</small>
                                    <small class="text-muted fw-bold">S</small>
                                </div>
                                <!-- Dynamic Calendar Grid -->
                                <?php
                                // Fetch attendance for current month
                                $attendanceData = [];
                                $attQuery = mysqli_query($conn, "SELECT DATE(date) as att_date, status FROM attendance WHERE emp_id='$emp_id' AND MONTH(date)='$currentMonth' AND YEAR(date)='$currentYear'");
                                while ($attRow = mysqli_fetch_assoc($attQuery)) {
                                    $attendanceData[$attRow['att_date']] = $attRow['status'];
                                }
                                
                                // Fetch approved leaves for current month
                                $leaveData = [];
                                $leaveQuery = mysqli_query($conn, "SELECT from_date, to_date FROM leave_requests WHERE emp_id='$emp_id' AND status='Approved' AND ((MONTH(from_date)='$currentMonth' AND YEAR(from_date)='$currentYear') OR (MONTH(to_date)='$currentMonth' AND YEAR(to_date)='$currentYear'))");
                                while ($leaveRow = mysqli_fetch_assoc($leaveQuery)) {
                                    $start = new DateTime($leaveRow['from_date']);
                                    $end = new DateTime($leaveRow['to_date']);
                                    $end->modify('+1 day');
                                    $interval = new DateInterval('P1D');
                                    $period = new DatePeriod($start, $interval, $end);
                                    foreach ($period as $dt) {
                                        $leaveData[$dt->format('Y-m-d')] = true;
                                    }
                                }
                                
                                // Calendar calculation
                                $firstDay = date('w', strtotime("$currentYear-$currentMonth-01")); // 0=Sun, 6=Sat
                                $todayDay = (int)date('d');
                                ?>
                                <div class="d-grid text-center"
                                    style="grid-template-columns: repeat(7, 1fr); gap: 6px;">
                                    <?php
                                    // Empty cells for days before 1st
                                    for ($i = 0; $i < $firstDay; $i++) {
                                        echo '<div class="p-2 rounded bg-light text-muted opacity-25"></div>';
                                    }
                                    
                                    // Days of month
                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $dateStr = sprintf('%s-%02d-%02d', $currentYear, $currentMonth, $day);
                                        $dayOfWeek = date('w', strtotime($dateStr));
                                        $isWeekend = ($dayOfWeek == 0 || $dayOfWeek == 6);
                                        $isToday = ($day == $todayDay);
                                        $isFuture = ($day > $todayDay);
                                        
                                        // Determine status
                                        $class = 'bg-light text-muted';
                                        if ($isFuture) {
                                            $class = 'bg-light text-muted';
                                        } elseif (isset($leaveData[$dateStr])) {
                                            $class = 'bg-warning-subtle text-warning-emphasis fw-bold';
                                        } elseif (isset($attendanceData[$dateStr])) {
                                            $status = $attendanceData[$dateStr];
                                            if ($status == 'Present') {
                                                $class = 'bg-success-subtle text-success fw-bold';
                                            } elseif ($status == 'Absent') {
                                                $class = 'bg-danger-subtle text-danger fw-bold';
                                            } elseif ($status == 'Half Day') {
                                                $class = 'bg-warning-subtle text-warning-emphasis fw-bold';
                                            }
                                        } elseif ($isWeekend) {
                                            $class = 'bg-light text-muted border';
                                        } elseif (!$isFuture) {
                                            // Past weekday with no attendance = absent
                                            $class = 'bg-danger-subtle text-danger fw-bold';
                                        }
                                        
                                        // Today border
                                        $todayBorder = $isToday ? ' border border-primary border-2' : '';
                                        
                                        echo "<div class=\"p-2 rounded $class$todayBorder\">$day</div>";
                                    }
                                    ?>
                                </div>

                                <div class="d-flex justify-content-center gap-3 mt-3 small">
                                    <div class="d-flex align-items-center gap-1"><span
                                            class="bg-success-subtle rounded-circle"
                                            style="width: 8px; height: 8px;"></span> Present</div>
                                    <div class="d-flex align-items-center gap-1"><span
                                            class="bg-danger-subtle rounded-circle"
                                            style="width: 8px; height: 8px;"></span> Absent</div>
                                    <div class="d-flex align-items-center gap-1"><span
                                            class="bg-warning-subtle rounded-circle"
                                            style="width: 8px; height: 8px;"></span> Leave</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: History List -->
                    <div class="col-12 col-lg-7 order-lg-1">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">Timesheet History
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Date</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">In</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Out</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Hrs</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1 text-end pe-4">
                                                Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $historySql = "SELECT a.date, 
                                                              (SELECT log_time FROM attendance_logs al WHERE al.attendance_id=a.attendance_id AND log_type='IN' ORDER BY log_id ASC LIMIT 1) as in_time,
                                                              (SELECT log_time FROM attendance_logs al WHERE al.attendance_id=a.attendance_id AND log_type='OUT' ORDER BY log_id DESC LIMIT 1) as out_time,
                                                              a.total_hours
                                                       FROM attendance a 
                                                       WHERE a.emp_id='$emp_id' 
                                                       ORDER BY a.date DESC LIMIT 5";
                                        $historyRes = mysqli_query($conn, $historySql);

                                        if (mysqli_num_rows($historyRes) > 0) {
                                            while ($row = mysqli_fetch_assoc($historyRes)) {
                                                $inTime = $row['in_time'] ? date('H:i', strtotime($row['in_time'])) : '-';
                                                $outTime = $row['out_time'] ? date('H:i', strtotime($row['out_time'])) : '-';
                                                // Calc Hours if missing
                                                $hours = '-';
                                                if ($row['in_time'] && $row['out_time']) {
                                                    $diff = strtotime($row['out_time']) - strtotime($row['in_time']);
                                                    $hours = gmdate("H:i", $diff);
                                                }
                                                ?>
                                                <tr>
                                                    <td class="ps-4 py-3 fw-medium text-dark">
                                                        <?php echo date('M d', strtotime($row['date'])); ?></td>
                                                    <td class="text-dark fw-bold"><?php echo $inTime; ?></td>
                                                    <td class="text-dark fw-bold"><?php echo $outTime; ?></td>
                                                    <td><span
                                                            class="badge bg-light text-dark border"><?php echo $hours; ?></span>
                                                    </td>
                                                    <td class="text-end pe-4 text-muted">-</td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center py-3'>No attendance history found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    </div>
    <?php include '../includes/footer.php'; ?>