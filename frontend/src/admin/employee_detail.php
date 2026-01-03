<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
if (!$id) {
    echo "Invalid ID";
    exit;
}

// Fetch Existing with Salary Structure
$sql = "SELECT e.*, u.email, r.role_name, 
        ss.basic_salary, ss.hra, ss.standard_allowance, ss.performance_bonus, ss.lta, ss.fixed_allowance, 
        ss.pf_employee, ss.pf_employer, ss.prof_tax, ss.work_days, ss.break_time, 
        ss.allowances as legacy_allow, ss.deductions as legacy_deduct
        FROM employees e 
        LEFT JOIN users u ON e.user_id = u.user_id 
        LEFT JOIN roles r ON u.role_id = r.role_id 
        LEFT JOIN salary_structures ss ON e.emp_id = ss.emp_id
        WHERE e.emp_id='$id'";
$res = mysqli_query($conn, $sql);
$emp = mysqli_fetch_assoc($res);

if (!$emp) {
    echo "Employee not found";
    exit;
}
$initials = substr($emp['first_name'], 0, 1) . substr($emp['last_name'], 0, 1);

// Handle Salary Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_structure'])) {
    $basic = floatval($_POST['basic']);
    $hra = floatval($_POST['hra']);
    $std = floatval($_POST['std']);
    $bonus = floatval($_POST['bonus']);
    $lta = floatval($_POST['lta']);
    $fixed = floatval($_POST['fixed']);
    $pf_emp = floatval($_POST['pf_emp']);
    $pf_empr = floatval($_POST['pf_empr']);
    $ptax = floatval($_POST['ptax']);
    $wDays = intval($_POST['work_days']);
    $bTime = intval($_POST['break_time']);

    // Upsert
    $check = mysqli_query($conn, "SELECT id FROM salary_structures WHERE emp_id='$id'");
    if (mysqli_num_rows($check) > 0) {
        $uSql = "UPDATE salary_structures SET 
                 basic_salary='$basic', hra='$hra', standard_allowance='$std', performance_bonus='$bonus', 
                 lta='$lta', fixed_allowance='$fixed', pf_employee='$pf_emp', pf_employer='$pf_empr', prof_tax='$ptax',
                 work_days='$wDays', break_time='$bTime'
                 WHERE emp_id='$id'";
    } else {
        $uSql = "INSERT INTO salary_structures 
                 (emp_id, basic_salary, hra, standard_allowance, performance_bonus, lta, fixed_allowance, pf_employee, pf_employer, prof_tax, work_days, break_time)
                 VALUES ('$id', '$basic', '$hra', '$std', '$bonus', '$lta', '$fixed', '$pf_emp', '$pf_empr', '$ptax', '$wDays', '$bTime')";
    }

    if (mysqli_query($conn, $uSql)) {
        echo "<script>alert('Salary Structure Updated'); location.href='employee_detail.php?id=$id';</script>";
        exit; // Reload to reflect changes
    } else {
        echo "<script>alert('Error updating salary');</script>";
    }
}
?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content (Wrapper) -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">

                <!-- Profile Header Card -->
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="bg-primary bg-opacity-10 h-100px"></div>
                        <div class="px-4 pb-4">
                            <div class="d-flex align-items-end mt-n5 mb-3">
                                <div class="bg-white p-1 rounded-circle shadow-sm me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold display-5"
                                        style="width: 100px; height: 100px;">
                                        <?php echo $initials; ?>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <h2 class="fw-bold mb-0"><?php echo $emp['first_name'] . ' ' . $emp['last_name']; ?>
                                    </h2>
                                    <p class="text-muted mb-0"><?php echo $emp['designation']; ?> ·
                                        <?php echo $emp['department']; ?>
                                    </p>
                                </div>
                                <div class="ms-auto mb-2 d-none d-md-block">
                                    <a href="employee_list.php" class="btn btn-outline-secondary btn-sm me-2">Back to
                                        List</a>
                                    <a href="edit_employee.php?id=<?php echo $id; ?>"
                                        class="btn btn-primary btn-sm">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Actions (Visible only on small screens) -->
                <div class="d-md-none mb-4">
                    <div class="d-grid gap-2">
                        <a href="edit_employee.php?id=<?php echo $id; ?>" class="btn btn-primary">Edit Profile</a>
                        <a href="employee_list.php" class="btn btn-outline-secondary">Back to List</a>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs nav-line-tabs mb-4 border-bottom-0" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="resume-tab" data-bs-toggle="tab" data-bs-target="#resume"
                            type="button" role="tab" aria-controls="resume" aria-selected="true">Resume</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="private-tab" data-bs-toggle="tab" data-bs-target="#private"
                            type="button" role="tab" aria-controls="private" aria-selected="false">Private Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary"
                            type="button" role="tab" aria-controls="salary" aria-selected="false">Salary Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security"
                            type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="profileTabsContent">

                    <!-- 1. Resume Tab -->
                    <div class="tab-pane fade show active" id="resume" role="tabpanel" aria-labelledby="resume-tab">
                        <div class="row g-4">
                            <div class="col-12 col-lg-8">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">About Me
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <p class="text-muted mb-0"><?php echo $emp['designation']; ?> at Dayflow.</p>
                                    </div>
                                </div>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Work
                                            Experience</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex mb-4">
                                            <div
                                                class="flex-shrink-0 bg-light rounded p-2 d-flex align-items-center justify-content-center me-3 h-50px w-50px">
                                                <span class="fw-bold text-muted">TC</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">Tech Corp Inc.</h6>
                                                <p class="text-muted small mb-1">Senior Developer · Full-time</p>
                                                <p class="text-muted small">Jan 2024 - Present · 1 yr</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div
                                                class="flex-shrink-0 bg-light rounded p-2 d-flex align-items-center justify-content-center me-3 h-50px w-50px">
                                                <span class="fw-bold text-muted">WS</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">Web Solutio</h6>
                                                <p class="text-muted small mb-1">Junior Developer · Full-time</p>
                                                <p class="text-muted small">Jun 2020 - Dec 2023 · 3 yrs 6 mos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Skills
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-light text-dark border">PHP</span>
                                            <span class="badge bg-light text-dark border">Laravel</span>
                                            <span class="badge bg-light text-dark border">JavaScript</span>
                                            <span class="badge bg-light text-dark border">MySQL</span>
                                            <span class="badge bg-light text-dark border">HTML5</span>
                                            <span class="badge bg-light text-dark border">CSS3</span>
                                            <span class="badge bg-light text-dark border">Git</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Private Info Tab -->
                    <div class="tab-pane fade" id="private" role="tabpanel" aria-labelledby="private-tab">
                        <div class="row g-4">
                            <!-- Personal Details -->
                            <!-- Personal Details -->
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Personal
                                            Details</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-3">
                                            <label class="text-muted small d-block mb-1">Join Date</label>
                                            <span
                                                class="fw-medium text-dark"><?php echo date('d M Y', strtotime($emp['join_date'])); ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small d-block mb-1">Direct Phone</label>
                                            <span class="fw-medium text-dark"><?php echo $emp['phone']; ?></span>
                                        </div>
                                        <div class="mb-0">
                                            <label class="text-muted small d-block mb-1">Email</label>
                                            <span class="fw-medium text-dark"><?php echo $emp['email']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address & Bank -->
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Address
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <label class="text-muted small d-block mb-1">Residing Address</label>
                                        <span
                                            class="fw-medium text-dark"><?php echo !empty($emp['address']) ? $emp['address'] : '<span class="text-muted fst-italic">Not provided</span>'; ?></span>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Bank
                                            Details</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">Bank Name</label>
                                                <span
                                                    class="fw-medium text-dark"><?php echo !empty($emp['bank_name']) ? $emp['bank_name'] : '-'; ?></span>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">IFSC Code</label>
                                                <span
                                                    class="fw-medium text-dark"><?php echo !empty($emp['ifsc_code']) ? $emp['ifsc_code'] : '-'; ?></span>
                                            </div>
                                            <div class="col-12">
                                                <label class="text-muted small d-block mb-1">Account Number</label>
                                                <span
                                                    class="fw-medium text-dark"><?php echo !empty($emp['account_number']) ? $emp['account_number'] : '-'; ?></span>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">PAN No</label>
                                                <span
                                                    class="fw-medium text-dark"><?php echo !empty($emp['pan_number']) ? $emp['pan_number'] : '-'; ?></span>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">UAN No</label>
                                                <span
                                                    class="fw-medium text-dark"><?php echo !empty($emp['uan_number']) ? $emp['uan_number'] : '-'; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Pre-calculation for Display
                    $basic = floatval($emp['basic_salary']);
                    $hra = floatval($emp['hra']);
                    $std = floatval($emp['standard_allowance']);
                    $bonus = floatval($emp['performance_bonus']);
                    $lta = floatval($emp['lta']);
                    $fixed = floatval($emp['fixed_allowance']);

                    $pf_emp = floatval($emp['pf_employee']);
                    $pf_empr = floatval($emp['pf_employer']);
                    $ptax = floatval($emp['prof_tax']);

                    $gross = $basic + $hra + $std + $bonus + $lta + $fixed;
                    $yearly = $gross * 12;

                    // Calculate Percentages for display if Basic > 0
                    $basic_pct = ($gross > 0) ? ($basic / $gross) * 100 : 0;
                    ?>

                    <!-- 3. Salary Info Tab (Admin Only) -->
                    <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">

                        <!-- Top Stats -->
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-6">
                                <div class="card bg-primary text-white border-0 shadow-sm">
                                    <div class="card-body p-4 position-relative">
                                        <div class="small text-white-50 text-uppercase ls-1 mb-1">Monthly Wage</div>
                                        <div class="display-6 fw-bold">₹ <?php echo number_format($gross, 2); ?></div>
                                        <div class="small text-white-50 mt-1">Yearly: ₹
                                            <?php echo number_format($yearly, 2); ?>
                                        </div>

                                        <button
                                            class="btn btn-sm btn-light text-primary position-absolute top-0 end-0 m-4 shadow-sm"
                                            onclick="openStructModal()">
                                            Edit Structure
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="small text-muted text-uppercase ls-1 mb-1">Working Days</div>
                                            <div class="h4 fw-bold mb-0 text-dark">
                                                <?php echo isset($emp['work_days']) ? $emp['work_days'] : 5; ?> Days
                                                <span class="text-muted fw-normal small">/ Week</span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="small text-muted text-uppercase ls-1 mb-1">Break Time</div>
                                            <div class="h4 fw-bold mb-0 text-dark">
                                                <?php echo isset($emp['break_time']) ? $emp['break_time'] : 45; ?> <span
                                                    class="text-muted fw-normal small">mins</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <!-- Salary Components (Earnings) -->
                            <div class="col-12 col-lg-7">
                                <div class="card border-0 shadow-sm h-100">
                                    <div
                                        class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Earnings
                                        </h5>
                                        <span class="badge bg-success-subtle text-success">Total: ₹
                                            <?php echo number_format($gross, 2); ?></span>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="bg-light text-muted small text-uppercase">
                                                <tr>
                                                    <th class="ps-4 py-3 fw-bold">Component</th>
                                                    <th class="py-3 fw-bold text-end">Amount</th>
                                                    <th class="pe-4 py-3 fw-bold text-end">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="ps-4 py-3">Basic Salary</td>
                                                    <td class="text-end fw-medium">₹
                                                        <?php echo number_format($basic, 2); ?>
                                                    </td>
                                                    <td class="pe-4 text-end text-muted small">
                                                        <?php echo number_format($basic_pct, 1); ?>% of Gross
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">House Rent Allowance (HRA)</td>
                                                    <td class="text-end fw-medium">₹
                                                        <?php echo number_format($hra, 2); ?>
                                                    </td>
                                                    <td class="pe-4 text-end text-muted small">Tax Exempt*</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Standard Allowance</td>
                                                    <td class="text-end fw-medium">₹
                                                        <?php echo number_format($std, 2); ?>
                                                    </td>
                                                    <td class="pe-4 text-end text-muted small">Fixed</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Performance Bonus</td>
                                                    <td class="text-end fw-medium">₹
                                                        <?php echo number_format($bonus, 2); ?>
                                                    </td>
                                                    <td class="pe-4 text-end text-muted small">Variable</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Leave Travel Allowance</td>
                                                    <td class="text-end fw-medium">₹
                                                        <?php echo number_format($lta, 2); ?>
                                                    </td>
                                                    <td class="pe-4 text-end text-muted small">Claimable</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Fixed Allowance</td>
                                                    <td class="text-end fw-medium">₹
                                                        <?php echo number_format($fixed, 2); ?>
                                                    </td>
                                                    <td class="pe-4 text-end text-muted small">Balancing</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Deductions -->
                            <div class="col-12 col-lg-5">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">PF
                                            Contribution</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                                            <div>
                                                <div class="text-dark fw-medium">Employee Share</div>
                                                <div class="small text-muted">12% of Basic</div>
                                            </div>
                                            <div class="text-end text-danger fw-bold">₹
                                                <?php echo number_format($pf_emp, 2); ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="text-dark fw-medium">Employer Share</div>
                                                <div class="small text-muted">12% of Basic</div>
                                            </div>
                                            <div class="text-end text-dark fw-bold">₹
                                                <?php echo number_format($pf_empr, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Tax
                                            Deductions</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="text-dark fw-medium">Professional Tax</div>
                                                <div class="small text-muted">Fixed Monthly</div>
                                            </div>
                                            <div class="text-end text-danger fw-bold">₹
                                                <?php echo number_format($ptax, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Security Tab -->
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-danger bg-opacity-10 py-3">
                                <h5 class="card-title mb-0 h6 text-danger fw-bold">Account Security</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="small text-muted mb-4">Manage access and high-level security settings.</p>
                                <div class="d-grid gap-3" style="max-width: 400px;">
                                    <button class="btn btn-outline-dark">Reset Password</button>
                                    <button class="btn btn-outline-danger">Deactivate Account</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>

    <!-- Edit Structure Modal -->
    <div class="modal fade" id="structModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Salary Components</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <input type="hidden" name="update_structure" value="1">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <h6 class="text-muted text-uppercase small ls-1 border-bottom pb-2">Earnings</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Basic Salary</label>
                                <input type="number" step="0.01" class="form-control" name="basic"
                                    value="<?php echo $basic; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">HRA</label>
                                <input type="number" step="0.01" class="form-control" name="hra"
                                    value="<?php echo $hra; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Standard Allowance</label>
                                <input type="number" step="0.01" class="form-control" name="std"
                                    value="<?php echo $std; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Performance Bonus</label>
                                <input type="number" step="0.01" class="form-control" name="bonus"
                                    value="<?php echo $bonus; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">LTA</label>
                                <input type="number" step="0.01" class="form-control" name="lta"
                                    value="<?php echo $lta; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fixed Allowance</label>
                                <input type="number" step="0.01" class="form-control" name="fixed"
                                    value="<?php echo $fixed; ?>" required>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="col-md-6">
                                    <label class="form-label">Approved Work Days/Week</label>
                                    <input type="number" class="form-control" name="work_days"
                                        value="<?php echo isset($emp['work_days']) ? $emp['work_days'] : 5; ?>"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Break Time (Mins)</label>
                                    <input type="number" class="form-control" name="break_time"
                                        value="<?php echo isset($emp['break_time']) ? $emp['break_time'] : 45; ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <h6 class="text-muted text-uppercase small ls-1 border-bottom pb-2">Deductions</h6>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">PF (Employee)</label>
                                <input type="number" step="0.01" class="form-control text-danger" name="pf_emp"
                                    value="<?php echo $pf_emp; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">PF (Employer)</label>
                                <input type="number" step="0.01" class="form-control" name="pf_empr"
                                    value="<?php echo $pf_empr; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Professional Tax</label>
                                <input type="number" step="0.01" class="form-control text-danger" name="ptax"
                                    value="<?php echo $ptax; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Structure</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const structModal = new bootstrap.Modal(document.getElementById('structModal'));
        function openStructModal() {
            structModal.show();
        }
    </script>
</body>