<?php

declare(strict_types=1);

namespace Src\Country\Application\get;

use Src\Country\Country;
use Src\Country\Domain\Contracts\CountryRepository;
use Src\Country\Domain\ValueObject\CountryName;

class GetCountryByCriteria
{
    public function __construct(private readonly CountryRepository $repository)
    {
    }

    public function __invoke(string $countryName): ?Country
    {
        $name = new CountryName($countryName);

        return $this->repository->findByCriteria($name);
    }
}