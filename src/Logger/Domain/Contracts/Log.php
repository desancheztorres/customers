<?php

declare(strict_types=1);

namespace Src\Logger\Domain\Contracts;

interface Log
{
    public function info(string $message): void;
}