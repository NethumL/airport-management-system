<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

class EmailHandler
{
    public static function sendEmail(string $recipient, string $recipientName, string $subject, string $template, array $args)
    {
        $body = self::renderTemplate($recipientName, __DIR__ . "/email_templates/$template.php", $args);
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = $_ENV["SMTP_HOST"];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV["SMTP_USERNAME"];
        $mail->Password = $_ENV["SMTP_PASSWORD"];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV["SMTP_PORT"];

        $mail->setFrom($_ENV["EMAIL_SENDER"], $_ENV["EMAIL_SENDER_NAME"]);
        $mail->addAddress($recipient, $recipientName);
        $mail->addReplyTo($_ENV["EMAIL_SENDER"], $_ENV["EMAIL_SENDER_NAME"]);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    }

    private static function renderTemplate(string $recipientName, string $templatePath, array $data): string
    {
        extract($data);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }
}
