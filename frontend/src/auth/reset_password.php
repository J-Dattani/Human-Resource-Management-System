<?php
session_start();
include '../config/db.php';

$token = isset($_GET['token']) ? mysqli_real_escape_string($conn, $_GET['token']) : '';
$email = isset($_GET['email']) ? mysqli_real_escape_string($conn, $_GET['email']) : '';
$error = '';
$success = '';

// Check Token Validity on Load
$now = date('Y-m-d H:i:s');
$check = mysqli_query($conn, "SELECT id FROM password_resets WHERE email='$email' AND token='$token' AND expires_at > '$now' LIMIT 1");
$isValid = (mysqli_num_rows($check) > 0);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $isValid) {
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($pass !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $hashed = password_hash($pass, PASSWORD_DEFAULT);

        // Update User
        $upd = mysqli_query($conn, "UPDATE users SET password='$hashed' WHERE email='$email'");

        if ($upd) {
            // Delete Token
            mysqli_query($conn, "DELETE FROM password_resets WHERE email='$email'");
            
            // Invalidate all remember tokens for this user (security)
            $userQ = mysqli_query($conn, "SELECT user_id FROM users WHERE email='$email'");
            if (mysqli_num_rows($userQ) > 0) {
                $uid = mysqli_fetch_assoc($userQ)['user_id'];
                mysqli_query($conn, "DELETE FROM remember_tokens WHERE user_id='$uid'");
            }

            $success = "Password has been reset successfully. Redirecting...";
            echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
        } else {
            $error = "Error updating password.";
        }
    }
}

$pageTitle = 'Reset Password - Dayflow HRMS';
include '../includes/head.php';
?>

<body>
    <main class="auth-container">
        <div class="card auth-card">
            <?php if (!$isValid): ?>
                <div class="text-center">
                    <div class="alert alert-danger">Invalid or expired reset link.</div>
                    <a href="forgot_password.php" class="btn btn-primary">Request New Link</a>
                </div>
            <?php else: ?>
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold" style="color: var(--primary);">Reset Password</h1>
                    <p class="text-muted">Create a new secure password</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger py-2 small">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success py-2 small">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <?php if (!$success): ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/auth.js"></script>
</body>

</html>