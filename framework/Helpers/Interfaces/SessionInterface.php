<?php

namespace Framework\Helpers\Interfaces;

/**
 * Interface SessionInterface
 * @package Framework\Helpers\Interfaces
 */
interface SessionInterface
{
    public static function set(string $key, string $value): string;
    public static function get(string $key): string;
    public static function delete(string $key) : bool;
    public static function has(string $key): bool;
    public static function destroy(): bool;
}