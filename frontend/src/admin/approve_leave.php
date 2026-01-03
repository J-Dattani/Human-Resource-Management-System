<?php
session_start();
include '../config/db.php';
include '../config/mail.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

$message = "";
$error = "";

// Handle Actions
if (isset($_POST['action']) && isset($_POST['request_id'])) {
    $req_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    $action = $_POST['action'];
    $status = ($action == 'approve') ? 'Approved' : 'Rejected';

    $updateQ = "UPDATE leave_requests SET status='$status' WHERE leave_id='$req_id'";
    if (mysqli_query($conn, $updateQ)) {
        $message = "Request $status successfully.";
        
        // Send Email Notification to Employee
        $leaveInfoQ = mysqli_query($conn, "SELECT lr.*, e.first_name, u.email 
                                           FROM leave_requests lr 
                                           JOIN employees e ON lr.emp_id = e.emp_id 
                                           JOIN users u ON e.user_id = u.user_id 
                                           WHERE lr.leave_id='$req_id'");
        if (mysqli_num_rows($leaveInfoQ) > 0) {
            $leaveInfo = mysqli_fetch_assoc($leaveInfoQ);
            $empEmail = $leaveInfo['email'];
            $empName = $leaveInfo['first_name'];
            $fromDate = date('M d, Y', strtotime($leaveInfo['from_date']));
            $toDate = date('M d, Y', strtotime($leaveInfo['to_date']));
            
            $subject = "Leave Request $status - Dayflow HRMS";
            $statusColor = ($status == 'Approved') ? '#28a745' : '#dc3545';
            $body = "<h3>Leave Request Update</h3>
                     <p>Hi $empName,</p>
                     <p>Your leave request has been <strong style='color: $statusColor;'>$status</strong>.</p>
                     <p><b>From:</b> $fromDate<br><b>To:</b> $toDate</p>
                     <p>If you have any questions, please contact HR.</p>
                     <p>Best regards,<br>Dayflow HRMS</p>";
            
            sendMail($empEmail, $subject, $body);
        }
    } else {
        $error = "Error updating request.";
    }
}

// Fetch Counts
$pendingQ = mysqli_query($conn, "SELECT COUNT(*) as count FROM leave_requests WHERE status='Pending'");
$pendingCount = mysqli_fetch_assoc($pendingQ)['count'];
?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <div class="dashboard-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 mb-1">Leave Requests</h2>
                        <p class="text-muted small">Manage and approve employee leave applications.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-light btn-sm text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                        <button class="btn btn-light btn-sm text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export
                        </button>
                    </div>
                </div>

                <div class="card border-0 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Pending Requests <span
                                class="badge badge-pill bg-orange-light text-warning ms-2"><?php echo $pendingCount; ?>
                                New</span></h3>
                        <?php if ($message): ?>
                            <div class="alert alert-success py-1 px-2 small mt-2 d-inline-block"><?php echo $message; ?>
                            </div><?php endif; ?>
                        <?php if ($error): ?>
                            <div class="alert alert-danger py-1 px-2 small mt-2 d-inline-block"><?php echo $error; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Leave Type</th>
                                    <th>Duration</th>
                                    <th>Reason</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pendListQ = mysqli_query($conn, "SELECT lr.*, e.first_name, e.last_name, e.emp_code, lt.leave_name 
                                                                  FROM leave_requests lr 
                                                                  JOIN employees e ON lr.emp_id=e.emp_id 
                                                                  JOIN leave_types lt ON lr.leave_type_id=lt.leave_type_id 
                                                                  WHERE lr.status='Pending' ORDER BY lr.applied_at ASC");
                                if (mysqli_num_rows($pendListQ) > 0) {
                                    while ($row = mysqli_fetch_assoc($pendListQ)) {
                                        $initials = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);
                                        $days = (strtotime($row['to_date']) - strtotime($row['from_date'])) / (60 * 60 * 24) + 1;
                                        $dateRange = date('M d', strtotime($row['from_date'])) . ' - ' . date('M d', strtotime($row['to_date']));
                                        ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-initial bg-blue-light text-primary me-2">
                                                        <?php echo $initials; ?>
                                                    </div>
                                                    <div>
                                                        <div class="fw-medium text-dark">
                                                            <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                                                        </div>
                                                        <div class="small text-muted"><?php echo $row['emp_code']; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span
                                                    class="badge badge-pill bg-purple-light text-primary"><?php echo $row['leave_name']; ?></span>
                                            </td>
                                            <td>
                                                <div class="text-dark small fw-medium"><?php echo $dateRange; ?></div>
                                                <div class="text-muted small"><?php echo round($days); ?> Days</div>
                                            </td>
                                            <td class="text-muted small" style="max-width: 250px;"><?php echo $row['reason']; ?>
                                            </td>
                                            <td class="text-end pe-4">
                                                <form action="" method="POST" class="d-inline">
                                                    <input type="hidden" name="request_id"
                                                        value="<?php echo $row['leave_id']; ?>">
                                                    <button type="submit" name="action" value="approve"
                                                        class="btn btn-light btn-sm text-success" title="Approve">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="" method="POST" class="d-inline">
                                                    <input type="hidden" name="request_id"
                                                        value="<?php echo $row['leave_id']; ?>">
                                                    <button type="submit" name="action" value="reject"
                                                        class="btn btn-light btn-sm text-danger" title="Reject">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No pending requests.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card border-0">
                    <div class="card-header">
                        <h3 class="card-title">Approval History</h3>
                    </div>
                    <div class="card-body py-0"> <!-- Removed text-center py-5 -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3">Employee</th>
                                        <th>Leave Type</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $histQ = mysqli_query($conn, "SELECT lr.*, e.first_name, e.last_name, lt.leave_name 
                                                      FROM leave_requests lr 
                                                      JOIN employees e ON lr.emp_id=e.emp_id 
                                                      JOIN leave_types lt ON lr.leave_type_id=lt.leave_type_id 
                                                      WHERE lr.status!='Pending' ORDER BY lr.applied_at DESC LIMIT 10");
                                    if (mysqli_num_rows($histQ) > 0) {
                                        while ($row = mysqli_fetch_assoc($histQ)) {
                                            $dateRange = date('M d', strtotime($row['from_date'])) . ' - ' . date('M d', strtotime($row['to_date']));
                                            $statusClass = 'text-success';
                                            if ($row['status'] == 'Rejected')
                                                $statusClass = 'text-danger';
                                            ?>
                                            <tr>
                                                <td class="ps-4 py-3 fw-medium">
                                                    <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                                                </td>
                                                <td><?php echo $row['leave_name']; ?></td>
                                                <td><?php echo $dateRange; ?></td>
                                                <td class="<?php echo $statusClass; ?> fw-bold"><?php echo $row['status']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center py-4 text-muted'>No history found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>