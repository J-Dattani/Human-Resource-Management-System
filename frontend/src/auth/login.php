<?php $pageTitle = 'Login - Dayflow HRMS';
include '../includes/head.php'; ?>

<body>

    <main class="auth-container">
        <div class="card auth-card">
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold" style="color: var(--primary);">Dayflow</h1>
                <p class="text-muted">Human Resource Management System</p>
            </div>

            <div class="mb-4">
                <h2 class="h5 mb-3">Sign In</h2>
                <form action="../index.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@company.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe"
                                style="border-color: var(--border);">
                            <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none small text-muted" style="transition: color 0.2s;">Forgot
                            password?</a>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div>

            <div class="text-center">
                <p class="small text-muted mb-0">Don't have an account? <a href="signup.php"
                        class="text-decoration-none fw-medium" style="color: var(--accent);">Sign up</a></p>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>