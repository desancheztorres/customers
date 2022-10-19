<?php

declare(strict_types=1);

namespace Src\Customer\Domain\Exceptions;

use RuntimeException;
use Throwable;

class CustomerEmptyPassword extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}