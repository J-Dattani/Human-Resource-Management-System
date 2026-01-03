<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

$msg = "";
$err = "";

// Handle Salary Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_salary'])) {
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $basic = mysqli_real_escape_string($conn, $_POST['basic_salary']);
    $allow = mysqli_real_escape_string($conn, $_POST['allowances']);
    $deduct = mysqli_real_escape_string($conn, $_POST['deductions']);

    // Upsert
    // First check if exists
    $check = mysqli_query($conn, "SELECT id FROM salary_structures WHERE emp_id='$emp_id'");
    if (mysqli_num_rows($check) > 0) {
        $sql = "UPDATE salary_structures SET basic_salary='$basic', allowances='$allow', deductions='$deduct' WHERE emp_id='$emp_id'";
    } else {
        $sql = "INSERT INTO salary_structures (emp_id, basic_salary, allowances, deductions) VALUES ('$emp_id', '$basic', '$allow', '$deduct')";
    }

    if (mysqli_query($conn, $sql)) {
        $msg = "Salary structure updated.";
    } else {
        $err = "Error updating salary: " . mysqli_error($conn);
    }
}
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
                        <h2 class="h4 mb-1">Payroll Management</h2>
                        <p class="text-muted small">Manage compensation and process monthly salaries.</p>
                    </div>
                    <button class="btn btn-primary d-flex align-items-center shadow-sm" onclick="openPayrollModal()">
                        <span class="me-2">₹</span> Run Payroll
                    </button>
                </div>

                <div class="card border-0">
                    <div class="card-header">
                        <h3 class="card-title">Employee Compensation</h3>
                        <?php if ($msg): ?>
                            <div class="alert alert-success mt-2"><?php echo $msg; ?></div><?php endif; ?>
                        <?php if ($err): ?>
                            <div class="alert alert-danger mt-2"><?php echo $err; ?></div><?php endif; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Basic Salary</th>
                                    <th>Allowances</th>
                                    <th>Deductions</th>
                                    <th>Net Salary</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT e.emp_id, e.first_name, e.last_name, e.designation, s.basic_salary, s.allowances, s.deductions 
                                        FROM employees e 
                                        LEFT JOIN salary_structures s ON e.emp_id = s.emp_id";
                                $res = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $basic = $row['basic_salary'] ? $row['basic_salary'] : 0;
                                    $allow = $row['allowances'] ? $row['allowances'] : 0;
                                    $deduct = $row['deductions'] ? $row['deductions'] : 0;
                                    $net = $basic + $allow - $deduct;
                                    $initials = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);
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
                                                    <div class="small text-muted"><?php echo $row['designation']; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-dark fw-medium">₹<?php echo number_format($basic, 2); ?></td>
                                        <td class="text-success small">+₹<?php echo number_format($allow, 2); ?></td>
                                        <td class="text-danger small">-₹<?php echo number_format($deduct, 2); ?></td>
                                        <td><span
                                                class="badge badge-pill bg-green-light text-success fw-bold p-2">₹<?php echo number_format($net, 2); ?></span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-light btn-sm text-primary"
                                                onclick="openEditModal('<?php echo $row['emp_id']; ?>', '<?php echo $basic; ?>', '<?php echo $allow; ?>', '<?php echo $deduct; ?>')">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editSalaryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Salary Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="" method="POST" id="editSalaryForm">
                        <input type="hidden" name="update_salary" value="1">
                        <input type="hidden" name="emp_id" id="edit_emp_id">
                        <div class="mb-3">
                            <label class="form-label small text-muted text-uppercase fw-bold">Basic Salary</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">₹</span>
                                <input type="number" class="form-control border-start-0 ps-0" name="basic_salary"
                                    id="edit_basic" step="0.01" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small text-muted text-uppercase fw-bold">Allowances</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">₹</span>
                                    <input type="number" class="form-control border-start-0 ps-0 text-success"
                                        name="allowances" id="edit_allow" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted text-uppercase fw-bold">Deductions</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">₹</span>
                                    <input type="number" class="form-control border-start-0 ps-0 text-danger"
                                        name="deductions" id="edit_deduct" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-center border">
                            <div class="small text-muted mb-1">Estimated Net Salary</div>
                            <div class="h4 mb-0 fw-bold text-dark" id="edit_net">₹0.00</div>
                        </div>

                        <div class="modal-footer border-top-0 pt-0 pb-4 justify-content-center">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Salary Modal -->
    <div class="modal fade" id="addSalaryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Salary Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="emp_id" id="modal_emp_id">
                        <div class="mb-3">
                            <label class="form-label">Employee</label>
                            <input type="text" class="form-control" id="modal_emp_name" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Basic Salary</label>
                            <input type="number" step="0.01" class="form-control" name="basic_salary" id="modal_basic"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Allowances</label>
                            <input type="number" step="0.01" class="form-control" name="allowances" id="modal_allow"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deductions</label>
                            <input type="number" step="0.01" class="form-control" name="deductions" id="modal_deduct"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_salary" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Generate Payroll Modal -->
    <div class="modal fade" id="generatePayrollModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Run Monthly Payroll</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This will calculate and generate payroll records for <strong>all active employees</strong> based
                        on their current salary structure.</p>
                    <div class="mb-3">
                        <label class="form-label">Select Month</label>
                        <input type="month" class="form-control" id="payroll_month" value="<?php echo date('Y-m'); ?>">
                    </div>
                    <div id="payrollResult" class="d-none alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="runPayroll()">Generate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(empId, basic, allow, deduct) {
            document.getElementById('edit_emp_id').value = empId;
            document.getElementById('edit_basic').value = basic;
            document.getElementById('edit_allow').value = allow;
            document.getElementById('edit_deduct').value = deduct;

            // Calculate Net
            updatedNet();

            var myModal = new bootstrap.Modal(document.getElementById('editSalaryModal'));
            myModal.show();
        }

        function updatedNet() {
            let b = parseFloat(document.getElementById('edit_basic').value) || 0;
            let a = parseFloat(document.getElementById('edit_allow').value) || 0;
            let d = parseFloat(document.getElementById('edit_deduct').value) || 0;
            let net = b + a - d;
            document.getElementById('edit_net').innerText = "₹" + net.toFixed(2);
        }

        // Add event listeners for dynamic update
        document.getElementById('edit_basic').addEventListener('input', updatedNet);
        document.getElementById('edit_allow').addEventListener('input', updatedNet);
        document.getElementById('edit_deduct').addEventListener('input', updatedNet);

        // Payroll Generation Logic
        const payrollModal = new bootstrap.Modal(document.getElementById('generatePayrollModal'));

        function openPayrollModal() {
            payrollModal.show();
        }

        function runPayroll() {
            const month = document.getElementById('payroll_month').value;
            const resultDiv = document.getElementById('payrollResult');
            const btn = document.querySelector('#generatePayrollModal .btn-primary');

            if (!month) {
                alert("Please select a month");
                return;
            }

            btn.disabled = true;
            btn.innerText = "Processing...";
            resultDiv.className = 'd-none alert';

            const formData = new FormData();
            formData.append('month', month);

            fetch('generate_payroll.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    resultDiv.classList.remove('d-none');
                    if (data.success) {
                        resultDiv.classList.add('alert-success');
                        resultDiv.classList.remove('alert-danger');
                        resultDiv.innerText = data.message;
                        setTimeout(() => { location.reload(); }, 2000);
                    } else {
                        resultDiv.classList.add('alert-danger');
                        resultDiv.classList.remove('alert-success');
                        resultDiv.innerText = data.error || "Unknown error";
                        btn.disabled = false;
                        btn.innerText = "Generate";
                    }
                })
                .catch(err => {
                    console.error(err);
                    resultDiv.classList.remove('d-none');
                    resultDiv.classList.add('alert-danger');
                    resultDiv.innerText = "Network or Server Error";
                    btn.disabled = false;
                    btn.innerText = "Generate";
                });
        }
    </script>
    <?php include '../includes/footer.php'; ?>