<?php

namespace Src\Country\Application\create;

class CreateCountryRequest
{
    public function __construct(private readonly string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

}