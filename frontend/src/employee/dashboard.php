<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar_employee.php'; ?>
        <main class="dashboard-main">
            <?php include '../includes/header_employee.php'; ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">

                <h2 class="h4 mb-4">Good Morning, John ☀️</h2>

                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <!-- Attendance Status Card (Check In/Out) -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0 bg-blue-light h-100">
                            <div class="d-flex flex-column h-100 justify-content-between">
                                <div>
                                    <div class="stat-label text-primary mb-1">Today's Status</div>
                                    <div class="stat-value text-primary">09:00 AM</div>
                                    <span class="badge bg-white text-primary mt-2">Checked In</span>
                                </div>
                                <a href="mark_attendance.php" class="btn btn-primary w-100 mt-3 btn-sm">Check Out</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card border-0 mb-0">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="stat-icon bg-green-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-blue-light text-primary">12 Left</span>
                            </div>
                            <div>
                                <div class="stat-value">Available</div>
                                <div class="stat-label">Leave Balance</div>
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
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="badge badge-pill bg-green-light text-success">Paid</span>
                            </div>
                            <div>
                                <div class="stat-value">$5,300</div>
                                <div class="stat-label">Last Salary</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Recent Activity & Calendar -->
                <div class="row g-3 mb-4">
                    <!-- Activity Log -->
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header pb-0 border-0">
                                <h3 class="card-title">Recent Attendance</h3>
                                <a href="mark_attendance.php" class="btn btn-light btn-sm">View All</a>
                            </div>
                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="modern-table">
                                        <thead>
                                            <tr>
                                                <th class="ps-3">Date</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="ps-3 fw-medium">Oct 24</td>
                                                <td>09:00 AM</td>
                                                <td>-</td>
                                                <td><span
                                                        class="badge badge-pill bg-orange-light text-warning">Working</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-3 fw-medium">Oct 23</td>
                                                <td>09:05 AM</td>
                                                <td>06:00 PM</td>
                                                <td><span
                                                        class="badge badge-pill bg-green-light text-success">Present</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-3 fw-medium">Oct 22</td>
                                                <td>09:00 AM</td>
                                                <td>06:00 PM</td>
                                                <td><span
                                                        class="badge badge-pill bg-green-light text-success">Present</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payslip Widget -->
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 h-100 mb-0">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title">Latest Payslip</h3>
                            </div>
                            <div class="card-body">
                                <div
                                    class="p-3 bg-light rounded-3 mb-3 border d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-medium text-dark mb-1">October 2026</div>
                                        <div class="small text-muted">$5,300.00 • Paid</div>
                                    </div>
                                    <div class="stat-icon bg-white border mb-0" style="width: 32px; height: 32px;">
                                        ⬇
                                    </div>
                                </div>
                                <a href="payroll.php" class="btn btn-outline-primary w-100 btn-sm">View History</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    <?php include '../includes/footer.php'; ?>