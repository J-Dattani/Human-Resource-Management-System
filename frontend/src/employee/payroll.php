<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Employee') {
    header("Location: ../auth/login.php");
    exit();
}

$uID = $_SESSION['user_id'];
// Get Emp ID
$eQ = mysqli_query($conn, "SELECT emp_id FROM employees WHERE user_id='$uID'");
$emp = mysqli_fetch_assoc($eQ);
$emp_id = $emp['emp_id'];

// Fetch Latest Payout
$latestSql = "SELECT * FROM payroll_history WHERE emp_id='$emp_id' ORDER BY payment_date DESC LIMIT 1";
$latestRes = mysqli_query($conn, $latestSql);
$latest = mysqli_fetch_assoc($latestRes);
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
                        <h1 class="h3 mb-1">Payroll History</h1>
                        <p class="text-muted">View your salary slips and payment details.</p>
                    </div>
                    <a href="dashboard.php" class="btn btn-outline-secondary">
                        <span class="me-1">←</span> Back to Dashboard
                    </a>
                </div>

                <div class="row g-4">

                    <!-- Latest Salary Card -->
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-5"
                                style="z-index: 0; opacity: 0.03;"></div>
                            <div class="card-body p-5 position-relative" style="z-index: 1;">
                                <?php if ($latest): ?>
                                    <h6 class="text-muted text-uppercase fw-bold ls-1 small mb-3">Latest Payout</h6>
                                    <h2 class="display-5 fw-bold mb-1 text-primary">
                                        ₹<?php echo number_format($latest['net_salary'], 2); ?></h2>
                                    <p class="text-muted small mb-4">Credited on
                                        <?php echo date('M d, Y', strtotime($latest['payment_date'])); ?>
                                    </p>

                                    <hr class="my-4 opacity-10">

                                    <!-- Earnings -->
                                    <h6 class="text-uppercase small text-muted fw-bold ls-1 mb-2">Earnings</h6>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small text-muted">Basic</span>
                                        <span
                                            class="small text-dark fw-medium">₹<?php echo number_format($latest['base_salary'], 2); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small text-muted">HRA</span>
                                        <span
                                            class="small text-dark fw-medium">₹<?php echo number_format($latest['hra'], 2); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small text-muted">Allowances</span>
                                        <span
                                            class="small text-success fw-medium">+₹<?php echo number_format($latest['standard_allowance'] + $latest['performance_bonus'] + $latest['lta'] + $latest['fixed_allowance'], 2); ?></span>
                                    </div>

                                    <!-- Deductions -->
                                    <h6 class="text-uppercase small text-muted fw-bold ls-1 mt-3 mb-2">Deductions</h6>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small text-muted">PF (Emp)</span>
                                        <span
                                            class="small text-danger fw-medium">-₹<?php echo number_format($latest['pf_employee'], 2); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="small text-muted">Tax</span>
                                        <span
                                            class="small text-danger fw-medium">-₹<?php echo number_format($latest['prof_tax'], 2); ?></span>
                                    </div>

                                    <button class="btn btn-primary w-100 shadow-sm" onclick="window.print()">Download
                                        Slip</button>
                                <?php else: ?>
                                    <div class="text-center py-5">
                                        <h5 class="text-muted">No payout history found.</h5>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Payment History Table -->
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">Payment History
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Month
                                            </th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Date Paid</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Net Salary
                                            </th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Status</th>
                                            <th class="pe-4 py-3 text-end text-uppercase text-muted small fw-bold ls-1">
                                                Slip
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $histSql = "SELECT * FROM payroll_history WHERE emp_id='$emp_id' ORDER BY payment_date DESC";
                                        $histRes = mysqli_query($conn, $histSql);
                                        if (mysqli_num_rows($histRes) > 0) {
                                            while ($row = mysqli_fetch_assoc($histRes)) {
                                                $monthName = date('F Y', strtotime($row['month'] . '-01'));
                                                ?>
                                                <tr>
                                                    <td class="ps-4 py-3 fw-medium text-dark"><?php echo $monthName; ?></td>
                                                    <td class="text-muted small">
                                                        <?php echo date('M d, Y', strtotime($row['payment_date'])); ?>
                                                    </td>
                                                    <td class="fw-medium text-dark">
                                                        ₹<?php echo number_format($row['net_salary'], 2); ?></td>
                                                    <td><span
                                                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2"><?php echo $row['status']; ?></span>
                                                    </td>
                                                    <td class="pe-4 text-end"><button
                                                            class="btn btn-sm btn-outline-secondary">Download</button></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No history found.</td></tr>";
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