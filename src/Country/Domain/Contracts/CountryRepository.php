<?php

declare(strict_types=1);

namespace Src\Country\Domain\Contracts;

use Src\Country\Country;
use Src\Country\Domain\ValueObject\CountryName;

interface CountryRepository
{
    public function save(Country $country): void;
    public function findByCriteria(CountryName $name): ?Country;
}