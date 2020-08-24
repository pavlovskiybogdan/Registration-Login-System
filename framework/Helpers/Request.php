<?php

declare(strict_types=1);

namespace Framework\Helpers;

use Framework\Component;

/**
 * Class Request
 * @property bool $isPost
 * @property bool $isGet
 * @property array $partialUrl
 * @property array $body
 * @property array|object $bodyParams
 * @package Framework\Helpers
 */
class Request extends Component
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        if (!empty($_SERVER['REQUEST_METHOD'])) {
            return $_SERVER['REQUEST_METHOD'];
        }

        return 'GET';
    }

    /**
     * @return bool
     */
    public function getIsPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * @return bool
     */
    public function getIsGet(): bool
    {
        return $this->getMethod() === 'GET';
    }

    /**
     * @return array
     */
    public function getPartialUrl(): array
    {
        return explode('/', $_SERVER['REQUEST_URI']);
    }

    /**
     * @return array|object
     */
    public function getBodyParams()
    {
        $stdin = file_get_contents('php://input');

        if (!empty($stdin)) {
            return json_decode($stdin);
        }

        return [];
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        if(isset($_POST)) {
            return $_POST;
        }

        return [];
    }

    /**
     * @return array
     */
    public function files(): array
    {
        if (isset($_FILES)) {
            return $_FILES;
        }

        return [];
    }
}