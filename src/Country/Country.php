<?php

declare(strict_types=1);

namespace Src\Country;

use Src\Country\Domain\ValueObject\CountryId;
use Src\Country\Domain\ValueObject\CountryName;

class Country
{
    public function __construct(
        private readonly CountryId $id,
        private readonly CountryName $name
    )
    {
    }

    public function id(): CountryId
    {
        return $this->id;
    }

    public function name(): CountryName
    {
        return $this->name;
    }

    public static function create(
        CountryId $id,
        CountryName $name
    ): self
    {
        return new self($id, $name);
    }


}