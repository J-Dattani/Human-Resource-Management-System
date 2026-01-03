<?php
/**
 * helpers.php
 *
 * Developer-friendly helper functions for sending HRMS emails.
 * This is the ONLY file other modules should use for sending mail.
 */

require_once __DIR__ . '/MailService.php';

/* =========================
   AUTH / ACCOUNT
   ========================= */

/**
 * Send welcome email to a new employee
 */
function sendWelcomeEmployeeMail(string $email, string $name): array
{
    return MailService::send(
        MailTypes::WELCOME_EMPLOYEE,
        $email,
        ['name' => $name]
    );
}

/**
 * Send email verification link
 */
function sendVerifyEmailMail(string $email, string $verifyLink): array
{
    return MailService::send(
        MailTypes::VERIFY_EMAIL,
        $email,
        ['link' => $verifyLink]
    );
}

/**
 * Send password reset email
 */
function sendPasswordResetMail(string $email, string $resetLink): array
{
    return MailService::send(
        MailTypes::PASSWORD_RESET,
        $email,
        ['link' => $resetLink]
    );
}

/* =========================
   LEAVE MANAGEMENT
   ========================= */

/**
 * Notify employee that leave was applied
 */
function sendLeaveAppliedMail(string $email): array
{
    return MailService::send(
        MailTypes::LEAVE_APPLIED,
        $email
    );
}

/**
 * Notify employee that leave was approved
 */
function sendLeaveApprovedMail(string $email): array
{
    return MailService::send(
        MailTypes::LEAVE_APPROVED,
        $email
    );
}

/**
 * Notify employee that leave was rejected
 */
function sendLeaveRejectedMail(string $email): array
{
    return MailService::send(
        MailTypes::LEAVE_REJECTED,
        $email
    );
}

/* =========================
   PAYROLL
   ========================= */

/**
 * Notify employee salary was updated
 */
function sendSalaryUpdatedMail(string $email): array
{
    return MailService::send(
        MailTypes::SALARY_UPDATED,
        $email
    );
}

/**
 * Notify employee salary slip is ready
 */
function sendSalarySlipReadyMail(string $email): array
{
    return MailService::send(
        MailTypes::SALARY_SLIP_READY,
        $email
    );
}

/* =========================
   GENERIC
   ========================= */

/**
 * Send a generic notification
 */
function sendGenericNotificationMail(string $email, string $subject, string $htmlBody): array
{
    return MailService::send(
        MailTypes::GENERIC_NOTIFICATION,
        $email,
        ['body' => $htmlBody],
        [
            'isHtml' => true,
            'altBody' => strip_tags($htmlBody),
        ]
    );
}
