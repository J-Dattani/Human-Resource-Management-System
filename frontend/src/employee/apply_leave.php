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
                        <h1 class="h3 mb-1">Leave Management</h1>
                        <p class="text-muted">Apply for new leave or check status.</p>
                    </div>
                    <a href="dashboard.php" class="btn btn-outline-secondary">
                        <span class="me-1">←</span> Back to Dashboard
                    </a>
                </div>

                <div class="row g-4">

                    <!-- Apply Leave Form -->
                    <div class="col-12 col-lg-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">New Request</h5>
                            </div>
                            <div class="card-body p-4">
                                <form>
                                    <div class="mb-4">
                                        <label for="leaveType" class="form-label">Leave Type</label>
                                        <select class="form-select" id="leaveType" required>
                                            <option value="" selected disabled>Select Type...</option>
                                            <option value="paid">Paid Leave</option>
                                            <option value="sick">Sick Leave</option>
                                            <option value="unpaid">Unpaid Leave</option>
                                        </select>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <label for="startDate" class="form-label">From Date</label>
                                            <input type="date" class="form-control" id="startDate" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="endDate" class="form-label">To Date</label>
                                            <input type="date" class="form-control" id="endDate" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="reason" class="form-label">Reason</label>
                                        <textarea class="form-control" id="reason" rows="3"
                                            placeholder="Brief reason for leave..." required></textarea>
                                    </div>

                                    <div class="d-grid pt-2">
                                        <button type="submit" class="btn btn-primary shadow-sm">Submit Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Leave History Table -->
                    <div class="col-12 col-lg-7">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">My Leave History
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Type</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Dates</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Days</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Mock Data -->
                                        <tr>
                                            <td class="ps-4 py-3"><span class="fw-medium text-dark">Sick Leave</span>
                                            </td>
                                            <td class="small text-muted">Oct 12 - Oct 13</td>
                                            <td>2</td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Approved</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3"><span class="fw-medium text-dark">Paid Leave</span>
                                            </td>
                                            <td class="small text-muted">Sep 01 - Sep 05</td>
                                            <td>5</td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Approved</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3"><span class="fw-medium text-dark">Unpaid Leave</span>
                                            </td>
                                            <td class="small text-muted">Nov 10 - Nov 10</td>
                                            <td>1</td>
                                            <td><span
                                                    class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2">Pending</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3"><span class="fw-medium text-dark">Sick Leave</span>
                                            </td>
                                            <td class="small text-muted">Aug 15</td>
                                            <td>1</td>
                                            <td><span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2">Rejected</span>
                                            </td>
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