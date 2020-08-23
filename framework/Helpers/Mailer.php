<?php

namespace Framework\Helpers;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

/**
 * Class Mailer
 * @package Framework\Helpers
 */
class Mailer
{
    /**
     * Current Mailer object
     */
    private Swift_SmtpTransport $transport;

    /**
     * Admin email for sending notification
     */
    private string $adminEmail;

    public function __construct()
    {
        $this->adminEmail = $_ENV['MAILER_USER'];

        $this->transport = (new Swift_SmtpTransport(
            $_ENV['MAILER_HOST'], $_ENV['MAILER_PORT'], $_ENV['MAILER_ENCRYPTION'])
        )->setUsername($this->adminEmail)->setPassword($_ENV['MAILER_PASSWORD']);
    }

    /**
     * @param string $to
     * @param string $token
     * @return bool
     */
    public function sendResetLink(string $to, string $token): bool
    {
        $message = "Reset password by this <a href='" . SCRIPT_ROOT . '/change-password/' . $token ."'>link</a>";

        return $this->send($to, 'Reset Password', $message);
    }

    /**
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public function send(string $to, string $subject, string $body): bool
    {
        $mailer = new Swift_Mailer($this->transport);
        $message = $this->createMessage($to, $subject, $body);

        if ($this->adminEmail === 'username@gmail.com') {
            return false;
        }

        return $mailer->send($message);
    }

    /**
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return Swift_Message
     */
    private function createMessage(string $to, string $subject, string $body): Swift_Message
    {
        return (new Swift_Message($subject))
            ->setFrom([$this->adminEmail => 'Admin'])
            ->setTo([$to])
            ->setBody($body, 'text/html');
    }
}