<?php $pageTitle = 'Sign Up - Dayflow HRMS';
include '../includes/head.php'; ?>

<body>

    <main class="auth-container">
        <div class="card auth-card" style="max-width: 500px;"> <!-- Slightly wider for more fields -->
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold" style="color: var(--primary);">Dayflow</h1>
                <p class="text-muted">Create your account</p>
            </div>

            <div class="mb-4">
                <form action="login.php" method="POST">

                    <div class="mb-3">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" placeholder="Acme Corp" required>
                    </div>

                    <div class="mb-3">
                        <label for="fullName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="John Doe" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="name@company.com" required>
                        </div>
                        <div class="col-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="+1 (555) 000-0000" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Create a password"
                                required style="border-right: 0;">
                            <span class="input-group-text bg-white toggle-password" data-target="password"
                                style="cursor: pointer; border-left: 0;">
                                <!-- Icon Show -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye icon-show" viewBox="0 0 16 16" style="color: var(--text-muted);">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                                <!-- Icon Hide -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-slash icon-hide d-none" viewBox="0 0 16 16"
                                    style="color: var(--text-muted);">
                                    <path
                                        d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                                    <path
                                        d="M11.297 9.32l.766.766A5.5 5.5 0 0 1 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8c.058-.087.122-.183.195-.288.335-.48.83-1.12 1.465-1.755.165-.165.337-.328.517-.486l.708.709c-.52.433-1.049.957-1.545 1.487C2.775 9.1 4.5 10.5 8 10.5c1.122 0 2.155-.145 3.097-.417zM10.4 7.698a2.5 2.5 0 0 0-3.098-3.098l3.097 3.097zM2.96 1.543l3.766 3.766a2.49 2.49 0 0 1 3.06 3.06l3.765 3.765a.5.5 0 0 0 .708-.708l-11.298-11.3a.5.5 0 0 0-.708.708z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Confirm your password" required style="border-right: 0;">
                            <span class="input-group-text bg-white toggle-password" data-target="confirmPassword"
                                style="cursor: pointer; border-left: 0;">
                                <!-- Icon Show -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye icon-show" viewBox="0 0 16 16" style="color: var(--text-muted);">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                                <!-- Icon Hide -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-slash icon-hide d-none" viewBox="0 0 16 16"
                                    style="color: var(--text-muted);">
                                    <path
                                        d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                                    <path
                                        d="M11.297 9.32l.766.766A5.5 5.5 0 0 1 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8c.058-.087.122-.183.195-.288.335-.48.83-1.12 1.465-1.755.165-.165.337-.328.517-.486l.708.709c-.52.433-1.049.957-1.545 1.487C2.775 9.1 4.5 10.5 8 10.5c1.122 0 2.155-.145 3.097-.417zM10.4 7.698a2.5 2.5 0 0 0-3.098-3.098l3.097 3.097zM2.96 1.543l3.766 3.766a2.49 2.49 0 0 1 3.06 3.06l3.765 3.765a.5.5 0 0 0 .708-.708l-11.298-11.3a.5.5 0 0 0-.708.708z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                </form>
            </div>

            <div class="text-center text-muted small">
                <p class="mb-0">Already have an account? <a href="login.php" class="text-decoration-none fw-medium"
                        style="color: var(--accent);">Sign in</a></p>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Auth JS -->
    <script src="../assets/js/auth.js"></script>
</body>

</html>