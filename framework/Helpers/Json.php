<?php

namespace Framework\Helpers;

/**
 * Class Json
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