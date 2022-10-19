<?php

declare(strict_types=1);

namespace Src\Country\Application\create;

use Src\Country\Country;
use Src\Country\Domain\Contracts\CountryRepository;
use Src\Country\Domain\Exceptions\CountryAlreadyExists;
use Src\Country\Domain\ValueObject\CountryId;
use Src\Country\Domain\ValueObject\CountryName;

class CountryCreator
{
    public function __construct(private readonly CountryRepository $repository)
    {
    }

    public function __invoke(string $countryId, string $countryName): void
    {
        $id = new CountryId($countryId);
        $name = new CountryName($countryName);

        try {
            $this->ensureCountryDoesntExist($name);

            $country = Country::create($id, $name);

            $this->repository->save($country);
        } catch (CountryAlreadyExists) {
            return;
        }
    }

    private function ensureCountryDoesntExist(CountryName $name): void
    {
        $existingCountry = $this->repository->findByCriteria($name);

        if (null !== $existingCountry) {
            throw new CountryAlreadyExists();
        }
    }
}