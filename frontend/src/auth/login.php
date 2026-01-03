<?php
session_start();
include '../config/db.php';

$error = '';

// Auto-Login via Cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $sqlToken = "SELECT user_id FROM remember_tokens WHERE token_hash='$token' AND expires_at > NOW() LIMIT 1";
    $resToken = mysqli_query($conn, $sqlToken);
    if (mysqli_num_rows($resToken) > 0) {
        $uID = mysqli_fetch_assoc($resToken)['user_id'];

        // Fetch User
        $sqlU = "SELECT u.user_id, r.role_name, e.emp_id, u.email FROM users u 
                 JOIN roles r ON u.role_id = r.role_id 
                 LEFT JOIN employees e ON u.user_id = e.user_id 
                 WHERE u.user_id='$uID' AND u.status='Active'";
        $resU = mysqli_query($conn, $sqlU);
        if ($row = mysqli_fetch_assoc($resU)) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role_name'];
            $_SESSION['email'] = $row['email'];
            if ($row['emp_id'])
                $_SESSION['emp_id'] = $row['emp_id'];
            // Refresh Token (Security Best Practice: Rotate Token)
            // For simplicity in this rapid phase, we keep it, but normally we'd rotate.
            header("Location: " . ((strtolower($row['role_name']) == 'admin') ? '../admin/dashboard.php' : '../employee/dashboard.php'));
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT u.user_id, u.password, r.role_name, e.emp_id 
            FROM users u 
            JOIN roles r ON u.role_id = r.role_id 
            LEFT JOIN employees e ON u.user_id = e.user_id 
            WHERE u.email = '$email' AND u.status = 'Active'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Hybrid Check: Hash OR Plain Text
        $isMatch = false;
        $isHashed = password_get_info($row['password'])['algo'];

        if ($isHashed) {
            if (password_verify($password, $row['password'])) {
                $isMatch = true;
            }
        } else {
            // Legacy Plain Check
            if ($password === $row['password']) {
                $isMatch = true;
                // Upgrade to Hash
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $uid = $row['user_id'];
                mysqli_query($conn, "UPDATE users SET password='$newHash' WHERE user_id='$uid'");
            }
        }

        if ($isMatch) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role_name'];
            $_SESSION['email'] = $email;
            if ($row['emp_id']) {
                $_SESSION['emp_id'] = $row['emp_id'];
            }

            // Remember Me
            if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                $token = bin2hex(random_bytes(32)); // Secure Random Token
                $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));
                $uid = $row['user_id'];

                // Store in DB
                mysqli_query($conn, "INSERT INTO remember_tokens (user_id, token_hash, expires_at) VALUES ('$uid', '$token', '$expiry')");

                // Set Cookie (HTTP Only)
                setcookie('remember_token', $token, time() + (86400 * 30), "/", "", false, true);
            }

            // Role-based Redirect
            if (strtolower($row['role_name']) === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../employee/dashboard.php");
            }
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    } else {
        $error = 'Invalid email or password.';
    }
}

$pageTitle = 'Login - Dayflow HRMS';
include '../includes/head.php';
?>

<body>

    <main class="auth-container">
        <div class="card auth-card">
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold" style="color: var(--primary);">Dayflow</h1>
                <p class="text-muted">Human Resource Management System</p>
            </div>

            <div class="mb-4">
                <h2 class="h5 mb-3">Sign In</h2>
                <?php if ($error): ?>
                    <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@company.com"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••"
                            required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember"
                                style="border-color: var(--border);">
                            <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                        </div>
                        <a href="forgot_password.php" class="text-decoration-none small text-muted"
                            style="transition: color 0.2s;">Forgot
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
    <!-- Auth JS -->
    <script src="../assets/js/auth.js"></script>
</body>

</html>