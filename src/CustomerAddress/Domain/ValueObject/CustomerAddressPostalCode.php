<?php

declare(strict_types=1);

namespace Src\CustomerAddress\Domain\ValueObject;

class CustomerAddressPostalCode
{
    public function __construct(protected ?string $value)
    {
    }

    public function value(): ?string
    {
        return $this->value;
    }
}