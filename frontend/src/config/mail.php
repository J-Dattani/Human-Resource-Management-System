<?php
// Include the shared HRMS sendMail logic
// Use absolute path to hrms mail system
$sharedMailPath = 'E:/HR/hrms/mail/sendMail.php';

if (file_exists($sharedMailPath)) {
    require_once $sharedMailPath;
} else {
    // Fallback: try relative path
    $relativePath = realpath(__DIR__ . '/../../../hrms/mail/sendMail.php');
    if ($relativePath && file_exists($relativePath)) {
        require_once $relativePath;
    } else {
        error_log("Shared HRMS mail file not found. Tried: " . $sharedMailPath);
    }
}

/**
 * Wrapper function to match the signature expected by frontend apps.
 * hrms_send_mail($to, $subject, $body, $isHtml, $altBody, $attachments)
 *
 * @param string $to
 * @param string $subject
 * @param string $body
 * @return bool
 */
function sendMail($to, $subject, $body)
{
    if (!function_exists('hrms_send_mail')) {
        error_log("hrms_send_mail function not found.");
        return false;
    }

    $result = hrms_send_mail($to, $subject, $body, true);

    if (!$result['ok']) {
        error_log("HRMS Mail Error: " . $result['error']);
        return false;
    }

    return true;
}
?>