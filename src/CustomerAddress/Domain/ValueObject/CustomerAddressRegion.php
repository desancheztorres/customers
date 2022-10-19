<?php

declare(strict_types=1);

namespace Src\CustomerAddress\Domain\ValueObject;

class CustomerAddressRegion
{
    public function __construct(protected ?string $value)
    {
    }

    public function value(): ?string
    {
        return $this->value;
    }
}