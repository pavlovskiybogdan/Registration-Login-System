<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use Throwable;

/**
 * Class QueryException
 * @package Framework\Exceptions
 */
class QueryException extends \Exception
{
    const DEFAULT_ERROR_MESSAGE = 'Incorrect syntax';

    public function __construct(
        $message = self::DEFAULT_ERROR_MESSAGE,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}