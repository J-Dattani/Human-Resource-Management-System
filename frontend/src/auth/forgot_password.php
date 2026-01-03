<?php
session_start();
include '../config/db.php';
include '../config/mail.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if email exists
    $check = mysqli_query($conn, "SELECT user_id, email FROM users WHERE email='$email' LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);

        // Generate Token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Save to DB
        $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', '$expires')";
        mysqli_query($conn, $sql);

        // Send Email
        $resetLink = "http://localhost:8080/auth/reset_password.php?token=$token&email=$email";
        $subject = "Reset Your Password - Dayflow HRMS";
        $body = "<h3>Password Reset Request</h3>
                 <p>We received a request to reset your password.</p>
                 <p>Click the link below to set a new password:</p>
                 <p><a href='$resetLink' style='padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Reset Password</a></p>
                 <p>This link expires in 1 hour.</p>
                 <p>If you didn't request this, please ignore this email.</p>";

        sendMail($email, $subject, $body);

        $success = "If an account exists, a reset link has been sent.";
    } else {
        // Security: Don't reveal if email exists, but for UX in this project user might expect feedback.
        // Prompt says "No indication... (security)". Complying.
        $success = "If an account exists, a reset link has been sent.";
    }
}

$pageTitle = 'Forgot Password - Dayflow HRMS';
include '../includes/head.php';
?>

<body>
    <main class="auth-container">
        <div class="card auth-card">
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold" style="color: var(--primary);">Forgot Password?</h1>
                <p class="text-muted">Enter your email to receive a reset link</p>
            </div>

            <?php if ($success): ?>
                <div class="alert alert-success py-2 small">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                    <a href="login.php" class="btn btn-light text-muted">Back to Login</a>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/auth.js"></script>
</body>

</html>