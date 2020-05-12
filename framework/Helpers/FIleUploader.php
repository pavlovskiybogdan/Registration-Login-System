<?php

namespace Framework\Helpers;

/**
 * Class FIleUploader
 * @package Framework\Helpers
 */
class FIleUploader
{
    const AVATAR_PATH = '/images/avatars/';
    const DEFAULT_AVATAR_PATH = BASE_PATH . '/app/assets/images/avatar.png';

    /**
     * Uploaded files directory
     */
    private string $uploadDir;

    public function __construct()
    {
        $this->uploadDir = BASE_PATH . '/app/storage';
    }

    /**
     * @param $file
     * @return string
     */
    public static function uploadAvatar($file): string
    {
        return (new static())->uploadImage($file, self::AVATAR_PATH);
    }

    /**
     * @param $imageFile
     * @param string $path
     * @return string
     */
    private function uploadImage($imageFile, $path = '/images'): string
    {
        $size = getimagesize($imageFile['tmp_name']);
        $temp  = explode('.', $imageFile['name']);

        $filename = $this->uploadDir
            . $path
            . round(microtime(true))
            . '.'
            . end($temp);

        if (!empty($size)) {
            return move_uploaded_file($imageFile['tmp_name'], $filename) ? $filename : '';
        }

        return '';
    }
}