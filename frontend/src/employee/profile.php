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
                                            <input type="text" class="form-control bg-light" value="John" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">Last Name</label>
                                            <input type="text" class="form-control bg-light" value="Doe" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">Email Address</label>
                                            <input type="email" class="form-control bg-light"
                                                value="john.doe@company.com" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small mb-1">Phone Number</label>
                                            <input type="tel" class="form-control bg-light" value="+1 (555) 123-4567"
                                                readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-1">Address</label>
                                            <textarea class="form-control bg-light" rows="2"
                                                readonly>123 Tech Park, Innovation Way, Silicon Valley, CA</textarea>
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
                                        <span class="fw-bold text-dark">EMP-001</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Department</label>
                                        <span class="fw-bold text-dark">Engineering</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Designation</label>
                                        <span class="fw-bold text-dark">Senior Developer</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small d-block mb-1">Joining Date</label>
                                        <span class="fw-bold text-dark">Jan 10, 2024</span>
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
                                        <span class="display-6 fw-bold">JD</span>
                                    </div>
                                </div>
                                <h5 class="mb-1 text-dark fw-bold">John Doe</h5>
                                <p class="text-muted small mb-4">Senior Developer • Engineering</p>

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