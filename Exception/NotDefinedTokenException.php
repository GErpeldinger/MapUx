<?php

declare(strict_types=1);

namespace MapUx\Exception;

use Exception;
use Throwable;

class NotDefinedTokenException extends Exception
{
    public function __construct(string $envVariable, int $code = 0, Throwable $previous = null)
    {
        $message = 'Environment variable "' . $envVariable . '" is not defined.';

        parent::__construct($message, $code, $previous);
    }
}
