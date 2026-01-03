<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$prevDate = date('Y-m-d', strtotime($date . ' -1 day'));
$nextDate = date('Y-m-d', strtotime($date . ' +1 day'));

?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">
                <!-- Header & Controls -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                    <div>
                        <h1 class="h3 mb-1">Attendance</h1>
                        <p class="text-muted mb-0">Daily timesheet records.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <!-- Date Navigation -->
                        <div class="d-flex align-items-center bg-white border rounded shadow-sm overflow-hidden">
                            <a href="?date=<?php echo $prevDate; ?>"
                                class="btn btn-link text-dark px-3 border-end text-decoration-none hover-bg-light"><i
                                    class="bi bi-chevron-left">&lt;</i></a>
                            <div class="d-flex align-items-center px-3 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar3 text-muted" viewBox="0 0 16 16">
                                    <path
                                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                    <path
                                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                                <span
                                    class="fw-semibold text-dark"><?php echo date('M d, Y', strtotime($date)); ?></span>
                            </div>
                            <a href="?date=<?php echo $nextDate; ?>"
                                class="btn btn-link text-dark px-3 border-start text-decoration-none hover-bg-light"><i
                                    class="bi bi-chevron-right">&gt;</i></a>
                        </div>
                        <a href="?date=<?php echo date('Y-m-d'); ?>" class="btn btn-white border shadow-sm">Today</a>
                    </div>
                </div>

                <!-- Search & Filters -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-2"
                                placeholder="Search employee...">
                        </div>
                    </div>
                </div>

                <!-- Timesheet Table -->
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Employee</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Check In</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Check Out</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Work Hours</th>
                                    <th class="pe-4 py-3 text-uppercase text-muted small fw-bold ls-1 text-end">Extra
                                        Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch all employees with attendance for selected date using attendance_logs
                                $sql = "SELECT e.emp_id, e.first_name, e.last_name, e.emp_code, a.attendance_id, a.status 
                                        FROM employees e 
                                        LEFT JOIN attendance a ON e.emp_id = a.emp_id AND a.date = '$date' 
                                        ORDER BY e.first_name ASC";
                                $res = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $initials = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);
                                        $checkIn = '—';
                                        $checkOut = '—';
                                        $workHours = "00:00";
                                        
                                        // Fetch check-in/out times from attendance_logs
                                        if ($row['attendance_id']) {
                                            $aid = $row['attendance_id'];
                                            // Get first IN time
                                            $inQ = mysqli_query($conn, "SELECT log_time FROM attendance_logs WHERE attendance_id='$aid' AND log_type='IN' ORDER BY log_id ASC LIMIT 1");
                                            if (mysqli_num_rows($inQ) > 0) {
                                                $inTime = mysqli_fetch_assoc($inQ)['log_time'];
                                                $checkIn = date('h:i A', strtotime($inTime));
                                            }
                                            // Get last OUT time
                                            $outQ = mysqli_query($conn, "SELECT log_time FROM attendance_logs WHERE attendance_id='$aid' AND log_type='OUT' ORDER BY log_id DESC LIMIT 1");
                                            if (mysqli_num_rows($outQ) > 0) {
                                                $outTime = mysqli_fetch_assoc($outQ)['log_time'];
                                                $checkOut = date('h:i A', strtotime($outTime));
                                            }
                                            // Calculate hours
                                            if (isset($inTime) && isset($outTime)) {
                                                $t1 = strtotime($inTime);
                                                $t2 = strtotime($outTime);
                                                $diff = $t2 - $t1;
                                                if ($diff > 0) {
                                                    $hours = floor($diff / (60 * 60));
                                                    $mins = floor(($diff - ($hours * 60 * 60)) / 60);
                                                    $workHours = sprintf("%02d:%02d", $hours, $mins);
                                                }
                                            }
                                        }

                                        $statusClass = "bg-light text-dark";
                                        $statusText = "Absent";
                                        if ($row['attendance_id']) {
                                            $statusClass = "bg-success-subtle text-success";
                                            $statusText = $row['status'] ?? "Present";
                                        }
                                        ?>
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold"
                                                        style="width: 32px; height: 32px;"><?php echo $initials; ?></div>
                                                    <div>
                                                        <div class="fw-bold text-dark">
                                                            <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></div>
                                                        <div class="small text-muted"><?php echo $row['emp_code']; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-medium text-dark"><?php echo $checkIn; ?></td>
                                            <td class="fw-medium text-dark"><?php echo $checkOut; ?></td>
                                            <td><span class="badge bg-light text-dark border"><?php echo $workHours; ?></span>
                                            </td>
                                            <td class="pe-4 text-end"><span class="text-muted">-</span></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No employees found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>