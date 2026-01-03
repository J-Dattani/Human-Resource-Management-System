<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
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
    $role_name = mysqli_real_escape_string($conn, $_POST['role']); // 'Employee' or 'Admin'
    // Format Name
    $parts = explode(" ", $full_name);
    $first_name = $parts[0];
    $last_name = isset($parts[1]) ? implode(" ", array_slice($parts, 1)) : '';

    // Check Email
    $check = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists!";
    } else {
        // Get Role ID
        $roleQ = mysqli_query($conn, "SELECT role_id FROM roles WHERE role_name='$role_name'");
        if (mysqli_num_rows($roleQ) == 0) {
            // Create Role if missing (Safety)
            mysqli_query($conn, "INSERT INTO roles (role_name) VALUES ('$role_name')");
            $role_id = mysqli_insert_id($conn);
        } else {
            $role_id = mysqli_fetch_assoc($roleQ)['role_id'];
        }

        // Create User (Default Pass: 123456) - Hashed for security
        $password = password_hash("123456", PASSWORD_DEFAULT);
        $userSql = "INSERT INTO users (role_id, email, password, status) VALUES ('$role_id', '$email', '$password', 'Active')";
        if (mysqli_query($conn, $userSql)) {
            $user_id = mysqli_insert_id($conn);

            // Create Employee
            $empSql = "INSERT INTO employees (user_id, first_name, last_name, email, phone, department, designation, join_date, emp_code) 
                       VALUES ('$user_id', '$first_name', '$last_name', '$email', '$phone', '$department', '$designation', CURDATE(), '$emp_code')";

            if (mysqli_query($conn, $empSql)) {
                $message = "Employee created successfully! Default password: 123456";
            } else {
                $error = "Error adding employee details: " . mysqli_error($conn);
            }
        } else {
            $error = "Error creating user: " . mysqli_error($conn);
        }
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

                <?php if ($message): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>

                <form action="" method="POST">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h2 class="h4 mb-1">Create Profile</h2>
                            <p class="text-muted small">Onboard a new staff member to Dayflow.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="employee_list.php" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Create Employee</button>
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
                                    <input type="text" class="form-control" name="full_name" placeholder="John Doe"
                                        required>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="john@company.com"
                                        required>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="+1 (555) 000-0000">
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Profile Picture URL</label>
                                    <input type="text" class="form-control" name="profile_picture"
                                        placeholder="https://...">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-medium text-muted">Residential Address</label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="1234 Main St, City, Country">
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
                                    <input type="text" class="form-control" name="emp_code" placeholder="EMP-001"
                                        required>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Department</label>
                                    <select class="form-select" name="department">
                                        <option>Engineering</option>
                                        <option>Design</option>
                                        <option>Marketing</option>
                                        <option>HR</option>
                                        <option>Sales</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Designation</label>
                                    <input type="text" class="form-control" name="designation"
                                        placeholder="e.g. Senior Developer">
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">Annual Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">$</span>
                                        <input type="number" class="form-control border-start-0 ps-0" name="salary"
                                            placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label small fw-medium text-muted">System Role</label>
                                    <select class="form-select" name="role" required>
                                        <option value="Employee">Employee</option>
                                        <option value="Admin">Admin</option>
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