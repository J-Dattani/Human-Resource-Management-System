<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content (Wrapper) -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">

                <!-- Profile Header Card -->
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="bg-primary bg-opacity-10 h-100px"></div>
                        <div class="px-4 pb-4">
                            <div class="d-flex align-items-end mt-n5 mb-3">
                                <div class="bg-white p-1 rounded-circle shadow-sm me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold display-5"
                                        style="width: 100px; height: 100px;">
                                        JD
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <h2 class="fw-bold mb-0">John Doe</h2>
                                    <p class="text-muted mb-0">Senior Developer · Engineering</p>
                                </div>
                                <div class="ms-auto mb-2 d-none d-md-block">
                                    <a href="employee_list.php" class="btn btn-outline-secondary btn-sm me-2">Back to
                                        List</a>
                                    <a href="edit_employee.php" class="btn btn-primary btn-sm">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Actions (Visible only on small screens) -->
                <div class="d-md-none mb-4">
                    <div class="d-grid gap-2">
                        <a href="edit_employee.php" class="btn btn-primary">Edit Profile</a>
                        <a href="employee_list.php" class="btn btn-outline-secondary">Back to List</a>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs nav-line-tabs mb-4 border-bottom-0" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="resume-tab" data-bs-toggle="tab" data-bs-target="#resume"
                            type="button" role="tab" aria-controls="resume" aria-selected="true">Resume</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="private-tab" data-bs-toggle="tab" data-bs-target="#private"
                            type="button" role="tab" aria-controls="private" aria-selected="false">Private Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary"
                            type="button" role="tab" aria-controls="salary" aria-selected="false">Salary Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security"
                            type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="profileTabsContent">

                    <!-- 1. Resume Tab -->
                    <div class="tab-pane fade show active" id="resume" role="tabpanel" aria-labelledby="resume-tab">
                        <div class="row g-4">
                            <div class="col-12 col-lg-8">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">About Me
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <p class="text-muted mb-0">Senior Developer with over 5 years of experience in
                                            building scalable web applications. Passionate about clean code, UI/UX
                                            design, and mentoring junior developers. Specialized in PHP, JavaScript,
                                            and modern frontend frameworks.</p>
                                    </div>
                                </div>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Work
                                            Experience</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex mb-4">
                                            <div
                                                class="flex-shrink-0 bg-light rounded p-2 d-flex align-items-center justify-content-center me-3 h-50px w-50px">
                                                <span class="fw-bold text-muted">TC</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">Tech Corp Inc.</h6>
                                                <p class="text-muted small mb-1">Senior Developer · Full-time</p>
                                                <p class="text-muted small">Jan 2024 - Present · 1 yr</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div
                                                class="flex-shrink-0 bg-light rounded p-2 d-flex align-items-center justify-content-center me-3 h-50px w-50px">
                                                <span class="fw-bold text-muted">WS</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">Web Solutio</h6>
                                                <p class="text-muted small mb-1">Junior Developer · Full-time</p>
                                                <p class="text-muted small">Jun 2020 - Dec 2023 · 3 yrs 6 mos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Skills
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-light text-dark border">PHP</span>
                                            <span class="badge bg-light text-dark border">Laravel</span>
                                            <span class="badge bg-light text-dark border">JavaScript</span>
                                            <span class="badge bg-light text-dark border">MySQL</span>
                                            <span class="badge bg-light text-dark border">HTML5</span>
                                            <span class="badge bg-light text-dark border">CSS3</span>
                                            <span class="badge bg-light text-dark border">Git</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Private Info Tab -->
                    <div class="tab-pane fade" id="private" role="tabpanel" aria-labelledby="private-tab">
                        <div class="row g-4">
                            <!-- Personal Details -->
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Personal
                                            Details</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-3">
                                            <label class="text-muted small d-block mb-1">Date of Birth</label>
                                            <span class="fw-medium text-dark">15 Aug 1995</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small d-block mb-1">Gender</label>
                                            <span class="fw-medium text-dark">Male</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small d-block mb-1">Marital Status</label>
                                            <span class="fw-medium text-dark">Single</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small d-block mb-1">Direct Phone</label>
                                            <span class="fw-medium text-dark">+1 (555) 123-4567</span>
                                        </div>
                                        <div class="mb-0">
                                            <label class="text-muted small d-block mb-1">Personal Email</label>
                                            <span class="fw-medium text-dark">john.doe.personal@gmail.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address & Bank -->
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Address
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <label class="text-muted small d-block mb-1">Residing Address</label>
                                        <span class="fw-medium text-dark">123 Tech Park, Silicon Valley, CA,
                                            94000</span>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Bank
                                            Details</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">Bank Name</label>
                                                <span class="fw-medium text-dark">HDFC Bank</span>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">IFSC Code</label>
                                                <span class="fw-medium text-dark">HDFC0001234</span>
                                            </div>
                                            <div class="col-12">
                                                <label class="text-muted small d-block mb-1">Account Number</label>
                                                <span class="fw-medium text-dark">12345678901234</span>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">PAN No</label>
                                                <span class="fw-medium text-dark">ABCDE1234F</span>
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted small d-block mb-1">UAN No</label>
                                                <span class="fw-medium text-dark">100900123456</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Salary Info Tab (Admin Only) -->
                    <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">

                        <!-- Top Stats -->
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-6">
                                <div class="card bg-primary text-white border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <div class="small text-white-50 text-uppercase ls-1 mb-1">Monthly Wage</div>
                                        <div class="display-6 fw-bold">₹ 50,000</div>
                                        <div class="small text-white-50 mt-1">Yearly: ₹ 6,00,000</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="small text-muted text-uppercase ls-1 mb-1">Working Days</div>
                                            <div class="h4 fw-bold mb-0 text-dark">5 Days <span
                                                    class="text-muted fw-normal small">/ Week</span></div>
                                        </div>
                                        <div class="text-end">
                                            <div class="small text-muted text-uppercase ls-1 mb-1">Break Time</div>
                                            <div class="h4 fw-bold mb-0 text-dark">45 <span
                                                    class="text-muted fw-normal small">mins</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <!-- Salary Components (Earnings) -->
                            <div class="col-12 col-lg-7">
                                <div class="card border-0 shadow-sm h-100">
                                    <div
                                        class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Earnings
                                        </h5>
                                        <span class="badge bg-success-subtle text-success">Total: ₹ 50,000</span>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="bg-light text-muted small text-uppercase">
                                                <tr>
                                                    <th class="ps-4 py-3 fw-bold">Component</th>
                                                    <th class="py-3 fw-bold text-end">Calculated</th>
                                                    <th class="pe-4 py-3 fw-bold text-end">Formula</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="ps-4 py-3">Basic Salary</td>
                                                    <td class="text-end fw-medium">₹ 25,000.00</td>
                                                    <td class="pe-4 text-end text-muted small">50%</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">House Rent Allowance (HRA)</td>
                                                    <td class="text-end fw-medium">₹ 12,500.00</td>
                                                    <td class="pe-4 text-end text-muted small">50% of Basic</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Standard Allowance</td>
                                                    <td class="text-end fw-medium">₹ 4,167.00</td>
                                                    <td class="pe-4 text-end text-muted small">Fixed</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Performance Bonus</td>
                                                    <td class="text-end fw-medium">₹ 2,082.50</td>
                                                    <td class="pe-4 text-end text-muted small">8.33%</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Leave Travel Allowance</td>
                                                    <td class="text-end fw-medium">₹ 2,082.50</td>
                                                    <td class="pe-4 text-end text-muted small">8.33%</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-4 py-3">Fixed Allowance</td>
                                                    <td class="text-end fw-medium">₹ 2,918.00</td>
                                                    <td class="pe-4 text-end text-muted small">Bal.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Deductions -->
                            <div class="col-12 col-lg-5">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">PF
                                            Contribution</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                                            <div>
                                                <div class="text-dark fw-medium">Employee Share</div>
                                                <div class="small text-muted">12% of Basic</div>
                                            </div>
                                            <div class="text-end text-danger fw-bold">₹ 3,000.00</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="text-dark fw-medium">Employer Share</div>
                                                <div class="small text-muted">12% of Basic</div>
                                            </div>
                                            <div class="text-end text-dark fw-bold">₹ 3,000.00</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h5 class="card-title mb-0 h6 fw-bold text-muted text-uppercase ls-1">Tax
                                            Deductions</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="text-dark fw-medium">Professional Tax</div>
                                                <div class="small text-muted">Fixed Monthly</div>
                                            </div>
                                            <div class="text-end text-danger fw-bold">₹ 200.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Security Tab -->
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-danger bg-opacity-10 py-3">
                                <h5 class="card-title mb-0 h6 text-danger fw-bold">Account Security</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="small text-muted mb-4">Manage access and high-level security settings.</p>
                                <div class="d-grid gap-3" style="max-width: 400px;">
                                    <button class="btn btn-outline-dark">Reset Password</button>
                                    <button class="btn btn-outline-danger">Deactivate Account</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <?php include '../includes/footer.php'; ?>