<?php include '../includes/head.php'; ?>

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
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 ps-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search text-muted" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control border-0 shadow-none ps-2"
                                        placeholder="Search by name, ID, or department...">
                                    <button class="btn btn-primary px-4 rounded-end" type="button">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Grid -->
                <div class="row g-4">
                    <!-- Employee Card 1 -->
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100 card-hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center text-primary"
                                        style="width: 80px; height: 80px; font-size: 1.5rem;">
                                        <span class="fw-bold">JD</span>
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">John Doe</h5>
                                <p class="text-muted small mb-3">Senior Developer</p>
                                <div class="mb-4">
                                    <span class="badge bg-light text-dark border me-1">Engineering</span>
                                    <span class="badge badge-pill bg-green-light text-success">Active</span>
                                </div>
                                <a href="employee_detail.php" class="btn btn-outline-primary w-100 rounded-pill">View
                                    Profile</a>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Card 2 -->
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100 card-hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center text-warning"
                                        style="width: 80px; height: 80px; font-size: 1.5rem;">
                                        <span class="fw-bold">JS</span>
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">Jane Smith</h5>
                                <p class="text-muted small mb-3">Product Designer</p>
                                <div class="mb-4">
                                    <span class="badge bg-light text-dark border me-1">Product</span>
                                    <span class="badge badge-pill bg-green-light text-success">Active</span>
                                </div>
                                <a href="employee_detail.php" class="btn btn-outline-primary w-100 rounded-pill">View
                                    Profile</a>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Card 3 -->
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100 card-hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center text-danger"
                                        style="width: 80px; height: 80px; font-size: 1.5rem;">
                                        <span class="fw-bold">RK</span>
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">Rahul Kumar</h5>
                                <p class="text-muted small mb-3">HR Manager</p>
                                <div class="mb-4">
                                    <span class="badge bg-light text-dark border me-1">HR</span>
                                    <span class="badge badge-warning text-dark">Admin</span>
                                </div>
                                <a href="employee_detail.php" class="btn btn-outline-primary w-100 rounded-pill">View
                                    Profile</a>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Card 4 (New Hire) -->
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100 card-hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="bg-purple-light rounded-circle d-inline-flex align-items-center justify-content-center text-primary"
                                        style="width: 80px; height: 80px; font-size: 1.5rem;">
                                        <span class="fw-bold">AS</span>
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">Alice Start</h5>
                                <p class="text-muted small mb-3">Marketing Intern</p>
                                <div class="mb-4">
                                    <span class="badge bg-light text-dark border me-1">Marketing</span>
                                    <span class="badge badge-pill bg-orange-light text-warning">Onboard</span>
                                </div>
                                <a href="employee_detail.php" class="btn btn-outline-primary w-100 rounded-pill">View
                                    Profile</a>
                            </div>
                        </div>
                    </div>
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