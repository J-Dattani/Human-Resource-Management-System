<?php
/**
 * MailService.php
 *
 * Central mail dispatcher for HRMS.
 * Connects MailTypes → MailTemplates → hrms_send_mail()
 */

require_once __DIR__ . '/MailTypes.php';
require_once __DIR__ . '/MailTemplates.php';
require_once __DIR__ . '/sendMail.php';

final class MailService
{
    /**
     * Send mail by type
     *
     * @param string $type MailTypes::*
     * @param string|array $to Recipient(s)
     * @param array $data Template data
     * @param array $options Optional overrides
     *        - isHtml (bool)
     *        - altBody (string|null)
     *        - attachments (array)
     *
     * @return array{ok:bool,error:?string}
     */
    public static function send(
        string $type,
        $to,
        array $data = [],
        array $options = []
    ): array {
        // Build subject & body from templates
        $template = MailTemplates::build($type, $data);

        $subject = $template['subject'] ?? 'HRMS Notification';
        $body    = $template['body'] ?? '';

        // Optional overrides
        $isHtml      = $options['isHtml'] ?? true;
        $altBody     = $options['altBody'] ?? null;
        $attachments = $options['attachments'] ?? [];

        // Delegate to mail engine
        return hrms_send_mail(
            $to,
            $subject,
            $body,
            $isHtml,
            $altBody,
            $attachments
        );
    }

    // 🚫 Prevent instantiation
    private function __construct() {}
}
