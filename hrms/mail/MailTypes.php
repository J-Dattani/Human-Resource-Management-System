<?php
/**
 * MailTypes.php
 *
 * Central registry of all mail types used in HRMS.
 * These constants define "what kind of mail" is being sent.
 */

final class MailTypes
{
    // 🔐 Authentication / Account
    public const WELCOME_EMPLOYEE   = 'welcome_employee';
    public const VERIFY_EMAIL       = 'verify_email';
    public const PASSWORD_RESET     = 'password_reset';

    // 🧾 Leave Management
    public const LEAVE_APPLIED      = 'leave_applied';
    public const LEAVE_APPROVED     = 'leave_approved';
    public const LEAVE_REJECTED     = 'leave_rejected';

    // 💰 Payroll
    public const SALARY_UPDATED     = 'salary_updated';
    public const SALARY_SLIP_READY  = 'salary_slip_ready';

    // 📢 System / Generic
    public const GENERIC_NOTIFICATION = 'generic_notification';

    // 🚫 Prevent instantiation
    private function __construct() {}
}
