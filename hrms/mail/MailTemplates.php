<?php
/**
 * MailTemplates.php
 *
 * Responsible for generating subject & body
 * for each MailTypes constant.
 */

require_once __DIR__ . '/MailTypes.php';

final class MailTemplates
{
    /**
     * Get mail subject + body by type
     *
     * @param string $type MailTypes::*
     * @param array $data Dynamic data for template
     * @return array{subject:string, body:string}
     */
    public static function build(string $type, array $data = []): array
    {
        switch ($type) {

            // 🔐 Account / Auth
            case MailTypes::WELCOME_EMPLOYEE:
                return [
                    'subject' => 'Welcome to HRMS',
                    'body' => self::welcomeEmployee($data),
                ];

            case MailTypes::VERIFY_EMAIL:
                return [
                    'subject' => 'Verify Your Email',
                    'body' => self::verifyEmail($data),
                ];

            case MailTypes::PASSWORD_RESET:
                return [
                    'subject' => 'Password Reset Request',
                    'body' => self::passwordReset($data),
                ];

            // 🧾 Leave
            case MailTypes::LEAVE_APPLIED:
                return [
                    'subject' => 'Leave Request Submitted',
                    'body' => self::leaveApplied($data),
                ];

            case MailTypes::LEAVE_APPROVED:
                return [
                    'subject' => 'Leave Approved',
                    'body' => self::leaveStatus($data, 'Approved'),
                ];

            case MailTypes::LEAVE_REJECTED:
                return [
                    'subject' => 'Leave Rejected',
                    'body' => self::leaveStatus($data, 'Rejected'),
                ];

            // 💰 Payroll
            case MailTypes::SALARY_UPDATED:
                return [
                    'subject' => 'Salary Updated',
                    'body' => self::salaryUpdated($data),
                ];

            case MailTypes::SALARY_SLIP_READY:
                return [
                    'subject' => 'Salary Slip Available',
                    'body' => self::salarySlipReady($data),
                ];

            // 📢 Fallback
            default:
                return [
                    'subject' => 'HRMS Notification',
                    'body' => self::generic($data),
                ];
        }
    }

    /* =========================
       Template Implementations
       ========================= */

    private static function welcomeEmployee(array $d): string
    {
        $name = $d['name'] ?? 'Employee';
        return "
            <h3>Welcome, {$name} 👋</h3>
            <p>Your HRMS account has been successfully created.</p>
            <p>You can now log in and access your dashboard.</p>
        ";
    }

    private static function verifyEmail(array $d): string
    {
        $link = $d['link'] ?? '#';
        return "
            <h3>Email Verification</h3>
            <p>Please verify your email address by clicking below:</p>
            <a href='{$link}'>Verify Email</a>
        ";
    }

    private static function passwordReset(array $d): string
    {
        $link = $d['link'] ?? '#';
        return "
            <h3>Password Reset</h3>
            <p>Click the link below to reset your password:</p>
            <a href='{$link}'>Reset Password</a>
        ";
    }

    private static function leaveApplied(array $d): string
    {
        return "
            <h3>Leave Request Submitted</h3>
            <p>Your leave request has been submitted and is pending approval.</p>
        ";
    }

    private static function leaveStatus(array $d, string $status): string
    {
        return "
            <h3>Leave {$status}</h3>
            <p>Your leave request has been <b>{$status}</b>.</p>
        ";
    }

    private static function salaryUpdated(array $d): string
    {
        return "
            <h3>Salary Updated</h3>
            <p>Your salary details have been updated in the HRMS system.</p>
        ";
    }

    private static function salarySlipReady(array $d): string
    {
        return "
            <h3>Salary Slip Available</h3>
            <p>Your salary slip is now available for download.</p>
        ";
    }

    private static function generic(array $d): string
    {
        return "
            <h3>HRMS Notification</h3>
            <p>You have a new notification from HRMS.</p>
        ";
    }

    // 🚫 Prevent instantiation
    private function __construct() {}
}
