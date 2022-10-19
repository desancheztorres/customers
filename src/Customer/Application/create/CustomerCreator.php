<?php

namespace Src\Customer\Application\create;

use Ramsey\Uuid\Uuid;
use Src\Country\Domain\Contracts\CountryRepository;
use Src\Country\Domain\ValueObject\CountryName;
use Src\Customer\Domain\Contracts\CustomerRepository;
use Src\Customer\Domain\Customer;
use Src\Customer\Domain\Exceptions\CustomerInvalidEmail;
use Src\Customer\Domain\ValueObject\CustomerBirthday;
use Src\Customer\Domain\ValueObject\CustomerEmail;
use Src\Customer\Domain\ValueObject\CustomerFirstName;
use Src\Customer\Domain\ValueObject\CustomerId;
use Src\Customer\Domain\ValueObject\CustomerLastName;
use Src\Customer\Domain\ValueObject\CustomerPassword;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressCity;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressId;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressPostalCode;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressRegion;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreet;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreetNumber;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreetSuffix;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressTelephone;
use Src\Logger\Domain\Contracts\Log;

class CustomerCreator
{
    public function __construct(
        private readonly CustomerRepository $customers,
        private readonly CountryRepository $countries,
        private readonly Log $logs
    )
    {
    }

    public function __invoke(
        string $customerId,
        string $customerFirstName,
        string $customerLastName,
        string $customerEmail,
        string $customerPassword,
        string $customerBirthday,
        string $customerCountry,
        string $customerRegion,
        string $customerCity,
        string $customerPostalCode,
        string $customerStreetSuffix,
        string $customerStreet,
        string $customerStreetNumber,
        string $customerTelephone,
    ): void
    {
        try {
            $id = new CustomerId($customerId);
            $firstName = new CustomerFirstName($customerFirstName);
            $lastname = new CustomerLastName($customerLastName);
            $email = new CustomerEmail($customerEmail);
            $password = new CustomerPassword($customerPassword);
            $birthday = new CustomerBirthday($customerBirthday);
            $customerAddressId = new CustomerAddressId(Uuid::uuid4()->toString());
            $countryName = new CountryName($customerCountry);
            $region = new CustomerAddressRegion($customerRegion);
            $city = new CustomerAddressCity($customerCity);
            $postalCode = new CustomerAddressPostalCode($customerPostalCode);
            $streetSuffix = new CustomerAddressStreetSuffix($customerStreetSuffix);
            $street = new CustomerAddressStreet($customerStreet);
            $streetNumber = new CustomerAddressStreetNumber($customerStreetNumber);
            $telephone = new CustomerAddressTelephone($customerTelephone);

            $customer = Customer::create($id, $firstName, $lastname, $email, $password, $birthday);

            $country = $this->countries->findByCriteria($countryName);

            $customerAddress = Customer::makeAddress(
                $customerAddressId,
                $country->id(),
                $id,
                $region,
                $city,
                $postalCode,
                $streetSuffix,
                $street,
                $streetNumber,
                $telephone
            );

            $this->customers->save($customer);
            $this->customers->saveAddress($customerAddress);

        } catch (CustomerInvalidEmail) {
            $this->logs->info("The Customer {$firstName->value()} has an invalid email");
        }
    }
}