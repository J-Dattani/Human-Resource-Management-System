<?php $pageTitle = 'Logged Out - Dayflow HRMS';
include '../includes/head.php'; ?>

<body>

    <main class="auth-container">
        <div class="card auth-card text-center">
            <div class="mb-4">
                <h1 class="h3 fw-bold" style="color: var(--primary);">Dayflow</h1>
                <p class="text-muted">Human Resource Management System</p>
            </div>

            <div class="py-4">
                <div class="mb-3 text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <h2 class="h5 mb-3">Logged Out Successfully</h2>
                <p class="text-muted small mb-4">You have been securely logged out of your session.</p>

                <a href="login.php" class="btn btn-primary w-100">Return to Login</a>
            </div>

            <div class="text-center text-muted small mt-3">
                <p class="mb-0">&copy; 2026 Dayflow HRMS.</p>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>