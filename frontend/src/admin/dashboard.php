<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">

                <h2 class="h4 mb-4">Admin Dashboard</h2>

                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-blue-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-green-light text-success">+12%</span>
                            </div>
                            <div>
                                <div class="stat-value">3,540</div>
                                <div class="stat-label">Total Employees</div>
                            </div>
                        </div>
                    </div>
                    <!-- Other stats... -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-orange-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-blue-light text-primary">Pending</span>
                            </div>
                            <div>
                                <div class="stat-value">3</div>
                                <div class="stat-label">Payroll Review</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-purple-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-orange-light text-warning">New</span>
                            </div>
                            <div>
                                <div class="stat-value">5</div>
                                <div class="stat-label">Leave Requests</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-purple-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="stat-value">Onboard</div>
                                <div class="stat-label">Quick Add Employee</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Smart Action Widgets -->
                <div class="row g-3 mb-4">
                    <!-- Pending Actions Widget (Smart) -->
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header pb-0 border-0">
                                <h3 class="card-title">Pending Leave Requests</h3>
                                <a href="approve_leave.php" class="btn btn-light btn-sm">View All</a>
                            </div>
                            <div class="card-body pt-2">
                                <div class="action-item">
                                    <div class="d-flex align-items-center w-100">
                                        <div class="avatar-initial bg-blue-light text-primary small">JD</div>
                                        <div class="ms-3 flex-grow-1">
                                            <div class="fw-medium text-dark small">John Doe</div>
                                            <div class="text-muted" style="font-size: 0.75rem;">Sick Leave • Oct 24-25
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-light btn-sm text-success p-1 px-2"
                                                title="Approve">✓</button>
                                            <button class="btn btn-light btn-sm text-danger p-1 px-2"
                                                title="Reject">✕</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="action-item">
                                    <div class="d-flex align-items-center w-100">
                                        <div class="avatar-initial bg-purple-light text-primary small">JS</div>
                                        <div class="ms-3 flex-grow-1">
                                            <div class="fw-medium text-dark small">Jane Smith</div>
                                            <div class="text-muted" style="font-size: 0.75rem;">Vacation • Nov 01-05
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-light btn-sm text-success p-1 px-2"
                                                title="Approve">✓</button>
                                            <button class="btn btn-light btn-sm text-danger p-1 px-2"
                                                title="Reject">✕</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Widget -->
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title">Quick Actions</h3>
                            </div>
                            <div class="card-body">
                                <a href="add_employee.php"
                                    class="btn btn-outline-secondary w-100 mb-2 d-flex align-items-center justify-content-center">
                                    <span class="me-2">+</span> Add Employee
                                </a>
                                <a href="add_salary.php"
                                    class="btn btn-outline-secondary w-100 mb-2 d-flex align-items-center justify-content-center">
                                    <span class="me-2">$</span> Run Payroll
                                </a>
                                <a href="employee_list.php"
                                    class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                                    <span class="me-2">☰</span> Employee Directory
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Employees Table -->
                <div class="card border-0 mb-0">
                    <div class="card-header border-0 pb-0">
                        <h3 class="card-title">Recent Employees</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Role</th>
                                    <th>Dept</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial bg-blue-light text-primary me-2">JD</div>
                                            <span class="fw-medium text-dark">John Doe</span>
                                        </div>
                                    </td>
                                    <td>Developer</td>
                                    <td>Engineering</td>
                                    <td><span class="badge badge-pill bg-green-light text-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial bg-purple-light text-primary me-2">JS</div>
                                            <span class="fw-medium text-dark">Jane Smith</span>
                                        </div>
                                    </td>
                                    <td>Designer</td>
                                    <td>Marketing</td>
                                    <td><span class="badge badge-pill bg-orange-light text-warning">Onboard</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>