<?php

namespace Src\Customer\Domain;

use Src\Country\Domain\ValueObject\CountryId;
use Src\Customer\Domain\ValueObject\CustomerBirthday;
use Src\Customer\Domain\ValueObject\CustomerEmail;
use Src\Customer\Domain\ValueObject\CustomerFirstName;
use Src\Customer\Domain\ValueObject\CustomerId;
use Src\Customer\Domain\ValueObject\CustomerLastName;
use Src\Customer\Domain\ValueObject\CustomerPassword;
use Src\CustomerAddress\CustomerAddress;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressCity;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressId;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressPostalCode;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressRegion;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreet;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreetNumber;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreetSuffix;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressTelephone;

class Customer
{
    public function __construct(
        private readonly CustomerId $customerId,
        private readonly CustomerFirstName $customerFirstName,
        private readonly CustomerLastName $customerLastName,
        private readonly CustomerEmail $customerEmail,
        private readonly CustomerPassword $customerPassword,
        private readonly CustomerBirthday $customerBirthday,
    )
    {
    }

    public function id(): CustomerId
    {
        return $this->customerId;
    }

    public function firstName(): CustomerFirstName
    {
        return $this->customerFirstName;
    }

    public function lastName(): CustomerLastName
    {
        return $this->customerLastName;
    }

    public function email(): CustomerEmail
    {
        return $this->customerEmail;
    }

    public function password(): CustomerPassword
    {
        return $this->customerPassword;
    }

    public function birthday(): CustomerBirthday
    {
        return $this->customerBirthday;
    }

    public static function create(
        CustomerId $customerId,
        CustomerFirstName $customerFirstName,
        CustomerLastName $customerLastName,
        CustomerEmail $customerEmail,
        CustomerPassword $customerPassword,
        CustomerBirthday $customerBirthday,
    ): self {
        return new self($customerId, $customerFirstName, $customerLastName, $customerEmail, $customerPassword, $customerBirthday);
    }

    public static function makeAddress(
        CustomerAddressId $id,
        CountryId $countryId,
        CustomerId $customerId,
        CustomerAddressRegion $region,
        CustomerAddressCity $city,
        CustomerAddressPostalCode $postalCode,
        CustomerAddressStreetSuffix $streetSuffix,
        CustomerAddressStreet $street,
        CustomerAddressStreetNumber $streetNumber,
        CustomerAddressTelephone $telephone
    ): CustomerAddress
    {
        return new CustomerAddress(
            $id,
            $countryId,
            $customerId,
            $region,
            $city,
            $postalCode,
            $streetSuffix,
            $street,
            $streetNumber,
            $telephone
        );
    }
}