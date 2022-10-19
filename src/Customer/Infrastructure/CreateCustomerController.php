<?php

namespace Src\Customer\Infrastructure;

use Ramsey\Uuid\Uuid;
use Src\Country\Infrastructure\Repositories\MySQLCountryRepository;
use Src\Customer\Application\create\CreateCustomerRequest;
use Src\Customer\Application\create\CustomerCreator;
use Src\Customer\Infrastructure\Repositories\MySQLCustomerRepository;
use Src\Logger\Infrastructure\Monolog;

class CreateCustomerController
{
    public function __construct(
        private readonly MySQLCustomerRepository $customers,
        private readonly MySQLCountryRepository $countries,
        private readonly Monolog $log
    )
    {
    }

    public function __invoke(CreateCustomerRequest $request): void
    {
        $id = Uuid::uuid4()->toString();
        $firstName = trim($request->firstName());
        $lastName = trim($request->lastName());
        $email = trim($request->email());
        $password = hash("md5", $request->password());
        $birthday = trim($request->birthday());
        $country = trim($request->country());
        $region = $request->region();
        $city = trim($request->city());
        $postal_code = $request->postalCode();
        $street_suffix = trim($request->streetSuffix());
        $street = trim($request->street());
        $street_number = trim($request->streetNumber());
        $telephone = $request->telephone() ?? '';

        $customerCreator = new CustomerCreator($this->customers, $this->countries, $this->log);
        $customerCreator(
            $id,
            $firstName,
            $lastName,
            $email,
            $password,
            $birthday,
            $country,
            $region,
            $city,
            $postal_code,
            $street_suffix,
            $street,
            $street_number,
            $telephone
        );

    }
}