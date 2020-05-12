<?php

namespace Framework\Helpers;

use Framework\Helpers\Interfaces\SessionInterface;

/**
 * Class Session
 * @package Framework\Helpers
 */
class Session implements SessionInterface
{
    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function set(string $key, string $value): string
    {
        if (isset($_SESSION)) {
            return $_SESSION[$key] = $value;
        }

        return '';
    }

    /**
     * @param string $key
     * @return string
     */
    public static function get(string $key): string
    {
        if (isset($_SESSION) && !empty($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return '';
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function delete(string $key): bool
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
            return true;
        }

        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return !empty($_SESSION[$key]);
    }

    /**
     * @return bool
     */
    public static function destroy(): bool
    {
        if (isset($_SESSION)) {
            $_SESSION = array();
            return session_destroy();
        }

        return false;
    }
}