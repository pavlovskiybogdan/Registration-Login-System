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
     * @var Swift_SmtpTransport
     */
    private $transport;

    /**
     * @var string
     */
    private $adminEmail;

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
        $config = require BASE_PATH . '/app/config/mail.php';

        $this->adminEmail = $config['username'];

        $this->transport = (new Swift_SmtpTransport($config['host'], $config['port'], $config['encryption']))
            ->setUsername($config['username'])
            ->setPassword($config['password']);
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