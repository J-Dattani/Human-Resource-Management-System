<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <div class="dashboard-content">

                <form>
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
                                    <input type="text" class="form-control" name="name" placeholder="John Doe" required>
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
                                    <input type="text" class="form-control" name="employee_id" placeholder="EMP-001"
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
                                        <option value="employee">Employee</option>
                                        <option value="admin">Admin</option>
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