<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Send an email using the global mail configuration.
 *
 * - Reads config from: hrms/config/mail.php
 * - Uses PHPMailer from: hrms/vendor/PHPMailer-master/
 * - Does not echo/print anything (returns status instead)
 *
 * @param string|array $to Recipient email or array of emails
 * @param string $subject
 * @param string $body
 * @param bool $isHtml
 * @param string|null $altBody
 * @param array $attachments Array of file paths
 * @return array{ok:bool,error:?string}
 */
function hrms_send_mail($to, string $subject, string $body, bool $isHtml = true, ?string $altBody = null, array $attachments = []): array
{
    $configPath = dirname(__DIR__) . '/config/mail.php';
    if (!is_file($configPath)) {
        return ['ok' => false, 'error' => 'Mail config not found'];
    }

    /** @var array $cfg */
    $cfg = require $configPath;
    $options = $cfg['options'] ?? [];

    $logEnabled = (bool)($options['log_mail'] ?? false);
    $logFile = dirname(__DIR__) . '/logs/mail.log';
    $log = static function (string $message) use ($logEnabled, $logFile): void {
        if (!$logEnabled) {
            return;
        }

        $line = '[' . date('c') . '] ' . $message . PHP_EOL;
        try {
            @file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
        } catch (\Throwable $e) {
            // intentionally ignore logging failures
        }
    };

    if (!($options['enable_mail'] ?? true)) {
        $log('Mail disabled (enable_mail=false). Skipped send. subject=' . $subject);
        return ['ok' => true, 'error' => null];
    }

    $vendorBase = dirname(__DIR__) . '/vendor/PHPMailer-master/src/';
    $phpmailerFile = $vendorBase . 'PHPMailer.php';
    $smtpFile = $vendorBase . 'SMTP.php';
    $exceptionFile = $vendorBase . 'Exception.php';

    if (!is_file($phpmailerFile) || !is_file($smtpFile) || !is_file($exceptionFile)) {
        return ['ok' => false, 'error' => 'PHPMailer library not found'];
    }

    require_once $exceptionFile;
    require_once $phpmailerFile;
    require_once $smtpFile;

    $smtp = $cfg['smtp'] ?? [];
    $creds = $cfg['credentials'] ?? [];
    $from = $cfg['from'] ?? [];

    $host = (string)($smtp['host'] ?? '');
    $port = (int)($smtp['port'] ?? 587);
    $encryption = (string)($smtp['encryption'] ?? 'tls');
    $auth = (bool)($smtp['auth'] ?? true);

    $username = (string)($creds['username'] ?? '');
    $password = (string)($creds['password'] ?? '');

    $fromEmail = (string)($from['email'] ?? $username);
    $fromName = (string)($from['name'] ?? 'HRMS System');

    if ($host === '' || $fromEmail === '') {
        return ['ok' => false, 'error' => 'Mail config incomplete'];
    }

    $toList = is_array($to) ? $to : [$to];
    $toList = array_values(array_filter(array_map(static function ($addr) {
        $addr = trim((string)$addr);
        return $addr === '' ? null : $addr;
    }, $toList)));

    try {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->Port = $port;
        $mail->SMTPAuth = $auth;
        $mail->Username = $username;
        $mail->Password = $password;

        if ($encryption === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        $debugEnabled = (bool)($options['debug'] ?? false);
        if ($debugEnabled) {
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = static function ($str, $level) use ($log) {
                $msg = '[HRMS MAIL DEBUG][' . $level . '] ' . $str;
                error_log($msg);
                $log($msg);
            };
        }

        // Safety if reused in loops or extended in future
        $mail->clearAddresses();
        $mail->clearAttachments();

        $mail->setFrom($fromEmail, $fromName);
        foreach ($toList as $addr) {
            $addr = trim((string)$addr);
            if ($addr !== '') {
                $mail->addAddress($addr);
            }
        }

        $subject = trim($subject) !== '' ? $subject : 'HRMS Notification';
        $mail->Subject = $subject;
        $mail->isHTML($isHtml);
        $mail->Body = $body;
        if ($altBody !== null) {
            $mail->AltBody = $altBody;
        } elseif ($isHtml) {
            $mail->AltBody = strip_tags($body);
        }

        foreach ($attachments as $path) {
            $path = (string)$path;
            if ($path !== '' && is_file($path)) {
                $mail->addAttachment($path);
            }
        }

        $mail->send();

        $log('[HRMS MAIL] Sent OK to: ' . implode(',', $toList) . ' | subject: ' . $subject);

        return ['ok' => true, 'error' => null];
    } catch (Exception $e) {
        $log('[HRMS MAIL] Failed to send | subject: ' . $subject . ' | error: ' . $e->getMessage());
        return ['ok' => false, 'error' => $e->getMessage()];
    } catch (\Throwable $e) {
        $log('[HRMS MAIL] Failed to send | subject: ' . $subject . ' | error: ' . $e->getMessage());
        return ['ok' => false, 'error' => $e->getMessage()];
    }
}
