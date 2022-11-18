<?php

namespace App\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class AuthenticationException extends Exception implements RendersErrorsExtensions
{
    /**
     * @var string
     */
    private $reason;

    /**
     * @param string $message
     * @param string $reason
     */
    public function __construct(string $message, string $reason)
    {
        parent::__construct($message);
        $this->reason = $reason;
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    public function getCategory(): string
    {
        return 'authentication';
    }

    public function extensionsContent(): array
    {
        return [
            'reason' => $this->reason
        ];
    }
}
