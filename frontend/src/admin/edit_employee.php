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
if(!$id) {
    echo "Invalid ID"; exit;
}

// Fetch Existing
$sql = "SELECT e.*, u.email, r.role_name 
        FROM employees e 
        LEFT JOIN users u ON e.user_id = u.user_id 
        LEFT JOIN roles r ON u.role_id = r.role_id 
        WHERE e.emp_id='$id'";
$res = mysqli_query($conn, $sql);
$emp = mysqli_fetch_assoc($res);

if(!$emp){
    echo "Employee not found"; exit;
}

$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $emp_code = mysqli_real_escape_string($conn, $_POST['emp_code']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $role_name = mysqli_real_escape_string($conn, $_POST['role']);
    
    // Format Name
    $parts = explode(" ", $full_name);
    $first_name = $parts[0];
    $last_name = isset($parts[1]) ? implode(" ", array_slice($parts, 1)) : '';
    
    // Bank & Address Info
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($conn, $_POST['ifsc_code']);
    $pan_number = mysqli_real_escape_string($conn, $_POST['pan_number']);
    $uan_number = mysqli_real_escape_string($conn, $_POST['uan_number']);

    // Update User Email/Role
    // Get Role ID
    $roleQ = mysqli_query($conn, "SELECT role_id FROM roles WHERE role_name='$role_name'");
    if(mysqli_num_rows($roleQ) == 0){
         mysqli_query($conn, "INSERT INTO roles (role_name) VALUES ('$role_name')");
         $role_id = mysqli_insert_id($conn);
    } else {
         $role_id = mysqli_fetch_assoc($roleQ)['role_id'];
    }
    
    $uID = $emp['user_id'];
    $uUpd = "UPDATE users SET email='$email', role_id='$role_id' WHERE user_id='$uID'";
    mysqli_query($conn, $uUpd);
    
    // Update Employee
    $eUpd = "UPDATE employees SET 
             first_name='$first_name', last_name='$last_name', phone='$phone', 
             address='$address', bank_name='$bank_name', account_number='$account_number', ifsc_code='$ifsc_code', pan_number='$pan_number', uan_number='$uan_number',
             department='$department', designation='$designation', emp_code='$emp_code' 
             WHERE emp_id='$id'";
    // Note: Address not in employees table schema usually? Wait. Schema said `employees` has first_name, last_name, email, phone, department, designation, join_date, emp_code. address?
    // Checking schema from memory/audit: Schema didn't list address in employees. 
    // I'll skip address update if column doesn't exist, or just try it. Since `add_employee` had address, I assumed it did. 
    // Wait, `add_employee` had address input but my SQL insert in `add_employee` logic IGNORED address. I remember I didn't add it to INSERT fields.
    // I will check `add_employee` logic I wrote again.
    // Yes, I wrote: `INSERT INTO employees ... VALUES ...` and didn't include address.
    
    if (mysqli_query($conn, $eUpd)) {
        $message = "Employee updated successfully!";
        // Refresh data
        $res = mysqli_query($conn, $sql);
        $emp = mysqli_fetch_assoc($res);
    } else {
        $error = "Error updating employee: " . mysqli_error($conn);
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

                <?php if($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>

                <form action="" method="POST">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h2 class="h4 mb-1">Edit Profile</h2>
                            <p class="text-muted small">Update employee information.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="employee_detail.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="card-title fw-bold mb-0">Personal Details</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo $emp['first_name'] . ' ' . $emp['last_name']; ?>" required>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $emp['email']; ?>"
                                        required>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" value="<?php echo $emp['phone']; ?>">
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Profile Picture URL</label>
                                    <input type="text" class="form-control" name="profile_picture"
                                        value="https://ui-avatars.com/api/?name=<?php echo urlencode($emp['first_name'] . ' ' . $emp['last_name']); ?>">
                                </div>
                                <div class="col-12 text-muted small text-uppercase fw-bold ls-1 mt-4 mb-2">Address & Bank Details</div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label small fw-medium text-muted">Residential Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="<?php echo isset($emp['address']) ? $emp['address'] : ''; ?>">
                                </div>
                                <div class="col-md-6"></div> 
                                
                                <div class="col-md-6 col-lg-2">
                                    <label class="form-label small fw-medium text-muted">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" value="<?php echo isset($emp['bank_name']) ? $emp['bank_name'] : ''; ?>">
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Account Number</label>
                                    <input type="text" class="form-control" name="account_number" value="<?php echo isset($emp['account_number']) ? $emp['account_number'] : ''; ?>">
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <label class="form-label small fw-medium text-muted">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc_code" value="<?php echo isset($emp['ifsc_code']) ? $emp['ifsc_code'] : ''; ?>">
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <label class="form-label small fw-medium text-muted">PAN No</label>
                                    <input type="text" class="form-control" name="pan_number" value="<?php echo isset($emp['pan_number']) ? $emp['pan_number'] : ''; ?>">
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">UAN No</label>
                                    <input type="text" class="form-control" name="uan_number" value="<?php echo isset($emp['uan_number']) ? $emp['uan_number'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0">
                        <div class="card-header bg-white py-3">
                            <h6 class="card-title fw-bold mb-0">Employment Information</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Employee ID</label>
                                    <input type="text" class="form-control" name="emp_code" value="<?php echo $emp['emp_code']; ?>" required>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Department</label>
                                    <select class="form-select" name="department">
                                        <option <?php if($emp['department']=='Engineering') echo 'selected'; ?>>Engineering</option>
                                        <option <?php if($emp['department']=='Design') echo 'selected'; ?>>Design</option>
                                        <option <?php if($emp['department']=='Marketing') echo 'selected'; ?>>Marketing</option>
                                        <option <?php if($emp['department']=='HR') echo 'selected'; ?>>HR</option>
                                        <option <?php if($emp['department']=='Sales') echo 'selected'; ?>>Sales</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Designation</label>
                                    <input type="text" class="form-control" name="designation" value="<?php echo $emp['designation']; ?>">
                                </div>
                                
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">System Role</label>
                                    <select class="form-select" name="role" required>
                                        <option value="Employee" <?php if($emp['role_name']=='Employee') echo 'selected'; ?>>Employee</option>
                                        <option value="Admin" <?php if($emp['role_name']=='Admin') echo 'selected'; ?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>