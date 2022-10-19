<?php

declare(strict_types=1);

namespace Src\Logger\Infrastructure;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Src\Logger\Domain\Contracts\Log;

class Monolog implements Log
{

    public function __construct(private readonly Logger $logger)
    {
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../../logs/app.log'));
    }

    public function info(string $message): void
    {
        $this->logger->info($message);
    }
}