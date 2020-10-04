<?php

declare(strict_types=1);

namespace Framework\Helpers;

use Framework\Application;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;

/**
 * Class Mailer
 * @package Framework\Helpers
 */
class Mailer
{
    const ERROR_STATUS_CODE = 0;

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
     * @return int
     */
    public function sendResetLink(string $to, string $token): int
    {
        return $this->send($to, 'Reset Password', $this->buildResetPasswordMessage($token));
    }

    /**
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return int
     */
    public function send(string $to, string $subject, string $body): int
    {
        $message = $this->createMessage($to, $subject, $body);

        if ($this->adminEmail === 'username@gmail.com') {
            return self::ERROR_STATUS_CODE;
        }

        return (new Swift_Mailer($this->transport))->send($message);
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

    /**
     * @param string $token
     * @return string
     */
    private function buildResetPasswordMessage(string $token): string
    {
        $link = Application::$app->request->fullHost . '/change-password/' . $token;

        return "Reset password by this <a href='$link'>link</a>";
    }
}
