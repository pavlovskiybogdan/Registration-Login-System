<?php

namespace Framework\Exceptions;

use Throwable;

class QueryException extends \Exception
{
    const ERROR_MESSAGE = 'Incorrect syntax';

    public function __construct($message = self::ERROR_MESSAGE, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}