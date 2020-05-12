<?php

namespace Framework\Helpers;

/**
 * Class Json
 * @package Framework\Helpers
 */
class Json {
    /**
     * Json constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $data = json_encode($message);
        echo $data;
    }
}