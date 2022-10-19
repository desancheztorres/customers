<?php

declare(strict_types=1);

namespace Src\Country\Infrastructure;

use Ramsey\Uuid\Uuid;
use Src\Country\Application\create\CountryCreator;
use Src\Country\Infrastructure\Repositories\MySQLCountryRepository;
use Src\Customer\Application\create\CreateCustomerRequest;

class CreateCountryController
{
    public function __construct(private readonly MySQLCountryRepository $countries)
    {
    }

    public function __invoke(CreateCustomerRequest $request): void
    {
        $id = Uuid::uuid4()->toString();
        $name = trim($request->country());

        $country = new CountryCreator($this->countries);
        $country($id, $name);
    }
}