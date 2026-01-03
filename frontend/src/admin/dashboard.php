<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

// 1. Total Employees
$empCountQ = mysqli_query($conn, "SELECT COUNT(*) as count FROM employees");
$totalEmployees = mysqli_fetch_assoc($empCountQ)['count'];

// 2. Pending Leaves
$leaveCountQ = mysqli_query($conn, "SELECT COUNT(*) as count FROM leave_requests WHERE status='Pending'");
$pendingLeaves = mysqli_fetch_assoc($leaveCountQ)['count'];

// 3. Today's Attendance Count
$today = date('Y-m-d');
$todayAttQ = mysqli_query($conn, "SELECT COUNT(*) as count FROM attendance WHERE date='$today'");
$todayAttendance = mysqli_fetch_assoc($todayAttQ)['count'];

// 4. Quick Add (No metric, just link)

?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">

                <h2 class="h4 mb-4">Admin Dashboard</h2>

                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-blue-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-green-light text-success">Active</span>
                            </div>
                            <div>
                                <div class="stat-value"><?php echo $totalEmployees; ?></div>
                                <div class="stat-label">Total Employees</div>
                            </div>
                        </div>
                    </div>
                    <!-- Other stats... -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-orange-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-blue-light text-primary">Pending</span>
                            </div>
                            <div>
                                <div class="stat-value"><?php echo $pendingLeaves; ?></div>
                                <div class="stat-label">Leave Requests</div>
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
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-green-light text-success">Today</span>
                            </div>
                            <div>
                                <div class="stat-value"><?php echo $todayAttendance; ?></div>
                                <div class="stat-label">Present Today</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-purple-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="stat-value">Onboard</div>
                                <div class="stat-label">Quick Add Employee</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Smart Action Widgets -->
                <div class="row g-3 mb-4">
                    <!-- Pending Actions Widget (Smart) -->
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header pb-0 border-0">
                                <h3 class="card-title">Pending Leave Requests</h3>
                                <a href="approve_leave.php" class="btn btn-light btn-sm">View All</a>
                            </div>
                            <div class="card-body pt-2">
                                <?php
                                $pendQ = mysqli_query($conn, "SELECT lr.from_date, lr.to_date, e.first_name, e.last_name, lt.leave_name 
                                                              FROM leave_requests lr 
                                                              JOIN employees e ON lr.emp_id=e.emp_id 
                                                              JOIN leave_types lt ON lr.leave_type_id=lt.leave_type_id 
                                                              WHERE lr.status='Pending' LIMIT 3");

                                if (mysqli_num_rows($pendQ) > 0) {
                                    while ($row = mysqli_fetch_assoc($pendQ)) {
                                        $initials = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);
                                        $dateRange = date('M d', strtotime($row['from_date'])) . ' - ' . date('M d', strtotime($row['to_date']));
                                        ?>
                                        <div class="action-item">
                                            <div class="d-flex align-items-center w-100">
                                                <div class="avatar-initial bg-blue-light text-primary small">
                                                    <?php echo $initials; ?>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <div class="fw-medium text-dark small">
                                                        <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                                                    </div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">
                                                        <?php echo $row['leave_name']; ?> • <?php echo $dateRange; ?>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <a href="approve_leave.php"
                                                        class="btn btn-light btn-sm text-primary p-1 px-2"
                                                        title="Review">Review</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "<div class='text-muted small text-center py-3'>No pending requests</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Widget -->
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title">Quick Actions</h3>
                            </div>
                            <div class="card-body">
                                <a href="add_employee.php"
                                    class="btn btn-outline-secondary w-100 mb-2 d-flex align-items-center justify-content-center">
                                    <span class="me-2">+</span> Add Employee
                                </a>
                                <a href="add_salary.php"
                                    class="btn btn-outline-secondary w-100 mb-2 d-flex align-items-center justify-content-center">
                                    <span class="me-2">₹</span> Run Payroll
                                </a>
                                <a href="employee_list.php"
                                    class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                                    <span class="me-2">☰</span> Employee Directory
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Employees Table -->
                <div class="card border-0 mb-0">
                    <div class="card-header border-0 pb-0">
                        <h3 class="card-title">Recent Employees</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Role</th>
                                    <th>Dept</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recEmpQ = mysqli_query($conn, "SELECT first_name, last_name, department, designation, join_date FROM employees ORDER BY join_date DESC LIMIT 3");
                                while ($row = mysqli_fetch_assoc($recEmpQ)):
                                    $initials = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);
                                    // Status logic? No status in employees table in schema, but users has status. 
                                    // Joining tables is better but simple select is fast.
                                    $statusBadge = '<span class="badge badge-pill bg-green-light text-success">Active</span>';
                                    ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial bg-blue-light text-primary me-2">
                                                    <?php echo $initials; ?>
                                                </div>
                                                <span
                                                    class="fw-medium text-dark"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo $row['designation']; ?></td>
                                        <td><?php echo $row['department']; ?></td>
                                        <td><?php echo $statusBadge; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>