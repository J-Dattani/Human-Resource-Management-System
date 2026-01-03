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
$sql = "SELECT e.*, u.email FROM employees e JOIN users u ON e.user_id = u.user_id WHERE e.user_id='$uID'";
$res = mysqli_query($conn, $sql);
$emp = mysqli_fetch_assoc($res);

if(!$emp){
    echo "Profile not found. Contact Admin."; exit;
}
$initials = substr($emp['first_name'],0,1) . substr($emp['last_name'],0,1);
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
                        <h1 class="h3 mb-1">My Profile</h1>
                        <p class="text-muted">Manage your personal details and account settings.</p>
                    </div>
                    <a href="dashboard.php" class="btn btn-outline-secondary">
                        <span class="me-1">←</span> Back to Dashboard
                    </a>
                </div>

                <div class="row g-4 justify-content-center">

                    <!-- Personal & Job Info -->
                    <div class="col-12 col-md-8">

                        <!-- Personal Details -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">Personal
                                    Information</h5>
                            </div>
                            <div class="card-body p-4">
                                <form>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">First Name</label>
                                            <input type="text" class="form-control bg-light" value="<?php echo $emp['first_name']; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">Last Name</label>
                                            <input type="text" class="form-control bg-light" value="<?php echo $emp['last_name']; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">Email Address</label>
                                            <input type="email" class="form-control bg-light"
                                                value="<?php echo $emp['email']; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">Phone Number</label>
                                            <input type="tel" class="form-control bg-light" value="<?php echo $emp['phone']; ?>"
                                                readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-1">Address</label>
                                            <textarea class="form-control bg-light" rows="2"
                                                readonly>Address not on file (Contact HR)</textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Employment Details -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">Employment Details
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Employee ID</label>
                                        <span class="fw-bold text-dark"><?php echo $emp['emp_code']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Department</label>
                                        <span class="fw-bold text-dark"><?php echo $emp['department']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Designation</label>
                                        <span class="fw-bold text-dark"><?php echo $emp['designation']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Joining Date</label>
                                        <span class="fw-bold text-dark"><?php echo date('M d, Y', strtotime($emp['join_date'])); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Sidebar -->
                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body p-5">
                                <div class="mb-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center text-primary"
                                        style="width: 100px; height: 100px;">
                                        <span class="display-6 fw-bold"><?php echo $initials; ?></span>
                                    </div>
                                </div>
                                <h5 class="mb-1 text-dark fw-bold"><?php echo $emp['first_name'] . ' ' . $emp['last_name']; ?></h5>
                                <p class="text-muted small mb-4"><?php echo $emp['designation']; ?> • <?php echo $emp['department']; ?></p>

                                <div class="d-grid gap-3">
                                    <button class="btn btn-outline-secondary" disabled>Edit Profile <span
                                            class="small d-block text-muted" style="font-size: 0.7em;">(Contact
                                            HR)</span></button>
                                    <button class="btn btn-outline-danger">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>