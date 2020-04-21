<?php

namespace Framework\Controller;

/**
 * Class Controller
 * @package Framework\Controller
 */
class Controller
{
    /**
     * @param string $url
     */
    protected function redirect(string $url)
    {
        return header('Location:' . $url);
    }
}