<?php
session_start();
include '../config/db.php';

$email = isset($_GET['email']) ? mysqli_real_escape_string($conn, $_GET['email']) : '';
$msg = '';
$err = '';

// Check for session messages from resend
if (isset($_SESSION['otp_success'])) {
    $msg = $_SESSION['otp_success'];
    unset($_SESSION['otp_success']);
}
if (isset($_SESSION['otp_error'])) {
    $err = $_SESSION['otp_error'];
    unset($_SESSION['otp_error']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputOtp = mysqli_real_escape_string($conn, $_POST['otp']);
    $emailPost = mysqli_real_escape_string($conn, $_POST['email']);
    $currentTime = date('Y-m-d H:i:s');

    // Check OTP
    $sql = "SELECT * FROM otp_verifications WHERE email='$emailPost' AND otp_code='$inputOtp' AND expires_at > '$currentTime' ORDER BY id DESC LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        // Valid OTP -> Activate User
        $updateAuth = mysqli_query($conn, "UPDATE users SET status='Active' WHERE email='$emailPost'");

        if ($updateAuth) {
            // Delete used OTPs
            mysqli_query($conn, "DELETE FROM otp_verifications WHERE email='$emailPost'");

            $msg = "Email verified successfully! You can now login.";
            echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
        } else {
            $err = "Error activating account. Please contact support.";
        }
    } else {
        $err = "Invalid or expired OTP.";
    }
}

$pageTitle = 'Verify Email - Dayflow HRMS';
include '../includes/head.php';
?>

<body>
    <main class="auth-container">
        <div class="card auth-card">
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold" style="color: var(--primary);">Verify Email</h1>
                <p class="text-muted">Enter the code sent to your email</p>
            </div>

            <div class="mb-4">
                <?php if ($msg): ?>
                    <div class="alert alert-success py-2 small">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                <?php if ($err): ?>
                    <div class="alert alert-danger py-2 small">
                        <?php echo $err; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="mb-4">
                        <label class="form-label text-center w-100">OTP Code</label>
                        <input type="text" class="form-control text-center fs-4 letter-spacing-2" name="otp"
                            maxlength="6" placeholder="123456" required autofocus>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Verify & Login</button>
                    </div>
                </form>
            </div>

            <div class="text-center">
                <p class="small text-muted mb-0">Didn't receive code? 
                    <a href="resend_otp.php?email=<?php echo urlencode($email); ?>" class="text-decoration-none">Resend</a>
                </p>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>