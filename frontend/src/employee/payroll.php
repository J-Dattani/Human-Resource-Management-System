<?php include '../includes/head.php'; ?>

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
                                <h6 class="text-muted text-uppercase fw-bold ls-1 small mb-3">Latest Payout</h6>
                                <h2 class="display-5 fw-bold mb-1 text-primary">$5,300.00</h2>
                                <p class="text-muted small mb-4">Credited on Oct 31, 2026</p>

                                <hr class="my-4 opacity-10">

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Basic Pay</span>
                                    <span class="fw-medium small text-dark">$5,000.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Allowances</span>
                                    <span class="fw-medium small text-success">+$500.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="text-muted small">Deductions</span>
                                    <span class="fw-medium small text-danger">-$200.00</span>
                                </div>

                                <button class="btn btn-primary w-100 shadow-sm">Download Slip</button>
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
                                        <!-- Mock Data -->
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">October 2026</td>
                                            <td class="text-muted small">Oct 31, 2026</td>
                                            <td class="fw-medium text-dark">$5,300.00</td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Paid</span>
                                            </td>
                                            <td class="pe-4 text-end"><button
                                                    class="btn btn-sm btn-outline-secondary">Download</button></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">September 2026</td>
                                            <td class="text-muted small">Sep 30, 2026</td>
                                            <td class="fw-medium text-dark">$5,300.00</td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Paid</span>
                                            </td>
                                            <td class="pe-4 text-end"><button
                                                    class="btn btn-sm btn-outline-secondary">Download</button></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">August 2026</td>
                                            <td class="text-muted small">Aug 31, 2026</td>
                                            <td class="fw-medium text-dark">$5,300.00</td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Paid</span>
                                            </td>
                                            <td class="pe-4 text-end"><button
                                                    class="btn btn-sm btn-outline-secondary">Download</button></td>
                                        </tr>
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