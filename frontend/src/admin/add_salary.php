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
                        <h2 class="h4 mb-1">Payroll Management</h2>
                        <p class="text-muted small">Manage compensation and process monthly salaries.</p>
                    </div>
                    <button class="btn btn-primary d-flex align-items-center shadow-sm">
                        <span class="me-2">$</span> Run Payroll
                    </button>
                </div>

                <div class="card border-0">
                    <div class="card-header">
                        <h3 class="card-title">Employee Compensation</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Basic Salary</th>
                                    <th>Allowances</th>
                                    <th>Deductions</th>
                                    <th>Net Salary</th>
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
                                                <div class="small text-muted">Software Engineer</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-dark fw-medium">$5,000</td>
                                    <td class="text-success small">+$500</td>
                                    <td class="text-danger small">-$200</td>
                                    <td><span
                                            class="badge badge-pill bg-green-light text-success fw-bold p-2">$5,300</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editSalaryModal">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial bg-purple-light text-primary me-2">JS</div>
                                            <div>
                                                <div class="fw-medium text-dark">Jane Smith</div>
                                                <div class="small text-muted">Product Manager</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-dark fw-medium">$7,000</td>
                                    <td class="text-success small">+$800</td>
                                    <td class="text-danger small">-$300</td>
                                    <td><span
                                            class="badge badge-pill bg-green-light text-success fw-bold p-2">$7,500</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editSalaryModal">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editSalaryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Salary Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label small text-muted text-uppercase fw-bold">Basic Salary</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">$</span>
                                <input type="number" class="form-control border-start-0 ps-0" value="5000">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small text-muted text-uppercase fw-bold">Allowances</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">$</span>
                                    <input type="number" class="form-control border-start-0 ps-0 text-success"
                                        value="500">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted text-uppercase fw-bold">Deductions</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">$</span>
                                    <input type="number" class="form-control border-start-0 ps-0 text-danger"
                                        value="200">
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-center border">
                            <div class="small text-muted mb-1">Estimated Net Salary</div>
                            <div class="h4 mb-0 fw-bold text-dark">$5,300.00</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 justify-content-center">
                    <button type="button" class="btn btn-primary w-100">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>