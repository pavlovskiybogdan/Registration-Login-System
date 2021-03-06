<?php

declare(strict_types=1);

namespace Framework\Helpers;

/**
 * Class Json
 * @package Framework\Helpers
 */
class Json
{
    /**
     * @param $message
     */
    public function __construct($message)
    {
        $data = json_encode($message);
        echo $data;
    }
}