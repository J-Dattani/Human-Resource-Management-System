<?php
session_start();
include '../config/db.php';
include '../config/mail.php';
include '../includes/head.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Employee') {
    header("Location: ../auth/login.php");
    exit();
}

$emp_id = $_SESSION['emp_id'];
$message = "";
$error = "";

// Handle Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leave_type_id = $_POST['leave_type_id'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    // Basic Validation
    if ($to_date < $from_date) {
        $error = "End date cannot be before start date.";
    } else {
        $sql = "INSERT INTO leave_requests (emp_id, leave_type_id, from_date, to_date, reason, status) 
                VALUES ('$emp_id', '$leave_type_id', '$from_date', '$to_date', '$reason', 'Pending')";

        if (mysqli_query($conn, $sql)) {
            $message = "Leave request submitted successfully!";

            // Send Notification to Admin
            // Fetch the first Admin's email from the database
            $adminValQuery = mysqli_query($conn, "SELECT email FROM users u JOIN roles r ON u.role_id = r.role_id WHERE r.role_name='Admin' AND u.status='Active' LIMIT 1");
            if (mysqli_num_rows($adminValQuery) > 0) {
                $adminRow = mysqli_fetch_assoc($adminValQuery);
                $adminEmail = $adminRow['email'];
            } else {
                $adminEmail = "hrms.odoo01@gmail.com"; // Fallback to system email
            }

            $subject = "New Leave Request - " . $from_date;
            $body = "<h3>New Leave Request</h3>
                     <p><b>Employee ID:</b> $emp_id</p>
                     <p><b>From:</b> $from_date <b>To:</b> $to_date</p>
                     <p><b>Reason:</b> $reason</p>
                     <p><a href='http://localhost:8080/admin/approve_leave.php'>Review Request</a></p>";

            sendMail($adminEmail, $subject, $body);

        } else {
            $error = "Error: " . mysqli_error($conn);
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
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h1 class="h3 mb-1">Leave Management</h1>
                        <p class="text-muted">Apply for new leave or check status.</p>
                    </div>
                    <a href="dashboard.php" class="btn btn-outline-secondary">
                        <span class="me-1">←</span> Back to Dashboard
                    </a>
                </div>

                <div class="row g-4">

                    <!-- Apply Leave Form -->
                    <div class="col-12 col-lg-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">New Request</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <?php if ($message): ?>
                                        <div class="alert alert-success py-2 small"><?php echo $message; ?></div>
                                    <?php endif; ?>
                                    <?php if ($error): ?>
                                        <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                    <form action="" method="POST">
                                        <div class="mb-4">
                                            <label for="leaveType" class="form-label">Leave Type</label>
                                            <select class="form-select" id="leaveType" name="leave_type_id" required>
                                                <option value="" selected disabled>Select Type...</option>
                                                <?php
                                                $typesQ = mysqli_query($conn, "SELECT * FROM leave_types");
                                                if (mysqli_num_rows($typesQ) > 0) {
                                                    while ($row = mysqli_fetch_assoc($typesQ)) {
                                                        echo "<option value='" . $row['leave_type_id'] . "'>" . $row['leave_name'] . "</option>";
                                                    }
                                                } else {
                                                    // Fallback if table empty
                                                    echo "<option value='1'>Paid Leave</option>";
                                                    echo "<option value='2'>Sick Leave</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-6">
                                                <label for="startDate" class="form-label">From Date</label>
                                                <input type="date" class="form-control" id="startDate" name="from_date"
                                                    required>
                                            </div>
                                            <div class="col-6">
                                                <label for="endDate" class="form-label">To Date</label>
                                                <input type="date" class="form-control" id="endDate" name="to_date"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="reason" class="form-label">Reason</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="3"
                                                placeholder="Brief reason for leave..." required></textarea>
                                        </div>

                                        <div class="d-grid pt-2">
                                            <button type="submit" class="btn btn-primary shadow-sm">Submit
                                                Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Leave History Table -->
                        <div class="col-12 col-lg-7">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">My Leave
                                        History
                                    </h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Type
                                                </th>
                                                <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Dates</th>
                                                <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Days</th>
                                                <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                            <?php
                                            $historySql = "SELECT lr.*, lt.leave_name 
                                                       FROM leave_requests lr 
                                                       LEFT JOIN leave_types lt ON lr.leave_type_id = lt.leave_type_id 
                                                       WHERE lr.emp_id='$emp_id' 
                                                       ORDER BY lr.applied_at DESC";
                                            $historyRes = mysqli_query($conn, $historySql);

                                            if (mysqli_num_rows($historyRes) > 0) {
                                                while ($row = mysqli_fetch_assoc($historyRes)) {
                                                    $days = (strtotime($row['to_date']) - strtotime($row['from_date'])) / (60 * 60 * 24) + 1;
                                                    $statusClass = 'bg-warning-subtle text-warning-emphasis border-warning-subtle';
                                                    if ($row['status'] == 'Approved')
                                                        $statusClass = 'bg-success-subtle text-success border-success-subtle';
                                                    if ($row['status'] == 'Rejected')
                                                        $statusClass = 'bg-danger-subtle text-danger border-danger-subtle';
                                                    ?>
                                                    <tr>
                                                        <td class="ps-4 py-3"><span
                                                                class="fw-medium text-dark"><?php echo $row['leave_name']; ?></span>
                                                        </td>
                                                        <td class="small text-muted">
                                                            <?php echo date('M d', strtotime($row['from_date'])) . ' - ' . date('M d', strtotime($row['to_date'])); ?>
                                                        </td>
                                                        <td><?php echo round($days); ?></td>
                                                        <td><span
                                                                class="badge <?php echo $statusClass; ?> border rounded-pill px-2"><?php echo $row['status']; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center py-3'>No leave history found.</td></tr>";
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

    <?php include '../includes/footer.php'; ?>