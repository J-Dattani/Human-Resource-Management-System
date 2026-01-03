<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <div class="dashboard-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 mb-1">Leave Requests</h2>
                        <p class="text-muted small">Manage and approve employee leave applications.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-light btn-sm text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                        <button class="btn btn-light btn-sm text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export
                        </button>
                    </div>
                </div>

                <div class="card border-0 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Pending Requests <span
                                class="badge badge-pill bg-orange-light text-warning ms-2">2 New</span></h3>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Leave Type</th>
                                    <th>Duration</th>
                                    <th>Reason</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial bg-blue-light text-primary me-2">JD</div>
                                            <div>
                                                <div class="fw-medium text-dark">John Doe</div>
                                                <div class="small text-muted">EMP-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-pill bg-purple-light text-primary">Paid Leave</span>
                                    </td>
                                    <td>
                                        <div class="text-dark small fw-medium">Oct 20 - Oct 22</div>
                                        <div class="text-muted small">2 Days</div>
                                    </td>
                                    <td class="text-muted small" style="max-width: 250px;">Family vacation planned
                                        months ago.</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm text-success" title="Approve">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-light btn-sm text-danger" title="Reject">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial bg-purple-light text-primary me-2">JS</div>
                                            <div>
                                                <div class="fw-medium text-dark">Jane Smith</div>
                                                <div class="small text-muted">EMP-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-pill bg-blue-light text-primary">Sick Leave</span></td>
                                    <td>
                                        <div class="text-dark small fw-medium">Oct 24</div>
                                        <div class="text-muted small">1 Day</div>
                                    </td>
                                    <td class="text-muted small" style="max-width: 250px;">Not feeling well today.</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm text-success" title="Approve">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-light btn-sm text-danger" title="Reject">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card border-0">
                    <div class="card-header">
                        <h3 class="card-title">Approval History</h3>
                    </div>
                    <div class="card-body text-center py-5">
                        <div class="mb-3 text-muted" style="opacity: 0.5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-muted small mb-0">No past leave requests found this month.</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>