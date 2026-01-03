<?php
session_start();
include '../config/db.php';
include '../includes/head.php';

// Check Auth
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

$search = "";
$where = "1";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "(first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR department LIKE '%$search%' OR emp_code LIKE '%$search%')";
}

// Fetch Employees with User Status
$sql = "SELECT e.*, u.status as user_status 
        FROM employees e 
        LEFT JOIN users u ON e.user_id = u.user_id 
        WHERE $where 
        ORDER BY e.first_name ASC";
$res = mysqli_query($conn, $sql);
?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content (Wrapper) -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h1 class="h3 mb-1">Employees</h1>
                        <p class="text-muted">View and manage all registered employees.</p>
                    </div>
                    <div>
                        <a href="add_employee.php" class="btn btn-primary">
                            <span class="me-1">+</span> Add Employee
                        </a>
                    </div>
                </div>

                <!-- Search & Filter -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2">
                                <form action="" method="GET" class="input-group">
                                    <span class="input-group-text bg-white border-0 ps-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search text-muted" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control border-0 shadow-none ps-2" name="search"
                                        placeholder="Search by name, ID, or department..."
                                        value="<?php echo htmlspecialchars($search); ?>">
                                    <button class="btn btn-primary px-4 rounded-end" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Grid -->
                <div class="row g-4">
                    <?php
                    if (mysqli_num_rows($res) > 0):
                        while ($row = mysqli_fetch_assoc($res)) {
                            $initials = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);
                            $bgColor = 'bg-primary bg-opacity-10 text-primary'; // Randomize if wanted
                            $statusBadge = ($row['user_status'] == 'Active')
                                ? '<span class="badge badge-pill bg-green-light text-success">Active</span>'
                                : '<span class="badge badge-pill bg-orange-light text-warning">Inactive</span>';
                            ?>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="card border-0 shadow-sm h-100 card-hover-effect">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <div class="<?php echo $bgColor; ?> rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px; font-size: 1.5rem;">
                                                <span class="fw-bold"><?php echo $initials; ?></span>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-1">
                                            <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h5>
                                        <p class="text-muted small mb-3"><?php echo $row['designation']; ?></p>
                                        <div class="mb-4">
                                            <span
                                                class="badge bg-light text-dark border me-1"><?php echo $row['department']; ?></span>
                                            <?php echo $statusBadge; ?>
                                        </div>
                                        <a href="employee_detail.php?id=<?php echo $row['emp_id']; ?>"
                                            class="btn btn-outline-primary w-100 rounded-pill">View Profile</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    else:
                        echo '<div class="col-12 text-center text-muted">No employees found.</div>';
                    endif;
                    ?>
                </div>

                <!-- Pagination -->
                <div class="py-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled"><a class="page-link border-0 bg-transparent text-muted"
                                    href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link border-0 rounded-circle bg-primary mx-1"
                                    href="#">1</a></li>
                            <li class="page-item"><a
                                    class="page-link border-0 rounded-circle bg-transparent text-muted mx-1"
                                    href="#">2</a></li>
                            <li class="page-item"><a
                                    class="page-link border-0 rounded-circle bg-transparent text-muted mx-1"
                                    href="#">3</a></li>
                            <li class="page-item"><a class="page-link border-0 bg-transparent text-primary"
                                    href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>