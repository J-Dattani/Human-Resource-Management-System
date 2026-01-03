<?php
session_start();
include '../config/db.php';
include '../config/mail.php';

$email = isset($_GET['email']) ? mysqli_real_escape_string($conn, $_GET['email']) : '';

if (empty($email)) {
    header("Location: login.php");
    exit();
}

// Rate limiting: Check last OTP sent time
$rateCheck = mysqli_query($conn, "SELECT created_at FROM otp_verifications WHERE email='$email' ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($rateCheck) > 0) {
    $lastOtp = mysqli_fetch_assoc($rateCheck);
    $lastSent = strtotime($lastOtp['created_at']);
    $now = time();
    $diff = $now - $lastSent;
    
    // Allow resend only after 60 seconds
    if ($diff < 60) {
        $wait = 60 - $diff;
        $_SESSION['otp_error'] = "Please wait $wait seconds before requesting a new OTP.";
        header("Location: verify_otp.php?email=" . urlencode($email));
        exit();
    }
}

// Delete old OTPs for this email
mysqli_query($conn, "DELETE FROM otp_verifications WHERE email='$email'");

// Fetch user info for email
$userQ = mysqli_query($conn, "SELECT u.user_id FROM users u WHERE u.email='$email' AND u.status='Inactive'");
if (mysqli_num_rows($userQ) == 0) {
    // Either already active or doesn't exist
    header("Location: login.php");
    exit();
}

// Get first name for personalization
$empQ = mysqli_query($conn, "SELECT e.first_name FROM employees e JOIN users u ON e.user_id = u.user_id WHERE u.email='$email'");
$firstName = "User";
if (mysqli_num_rows($empQ) > 0) {
    $firstName = mysqli_fetch_assoc($empQ)['first_name'];
}

// Generate new OTP
$otp = rand(100000, 999999);
$expiresAt = date('Y-m-d H:i:s', strtotime('+10 minutes'));

$sqlOtp = "INSERT INTO otp_verifications (email, otp_code, expires_at) VALUES ('$email', '$otp', '$expiresAt')";
mysqli_query($conn, $sqlOtp);

// Send OTP Email
$subject = "Verify Your Email - Dayflow HRMS";
$body = "<h3>Verify Your Email</h3>
         <p>Hi $firstName,</p>
         <p>You requested a new verification code. Please use the OTP below to verify your email address and activate your account.</p>
         <h2 style='background: #eee; padding: 10px; display: inline-block; letter-spacing: 5px;'>$otp</h2>
         <p>This code expires in 10 minutes.</p>
         <p>If you didn't request this, please ignore this email.</p>";

sendMail($email, $subject, $body);

$_SESSION['otp_success'] = "A new OTP has been sent to your email.";
header("Location: verify_otp.php?email=" . urlencode($email));
exit();
?>
