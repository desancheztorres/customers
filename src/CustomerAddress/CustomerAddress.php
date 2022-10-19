<?php

declare(strict_types=1);

namespace Src\CustomerAddress;

use Src\Country\Domain\ValueObject\CountryId;
use Src\Customer\Domain\ValueObject\CustomerId;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressCity;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressId;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressPostalCode;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressRegion;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreet;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreetNumber;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressStreetSuffix;
use Src\CustomerAddress\Domain\ValueObject\CustomerAddressTelephone;

class CustomerAddress
{
    public function __construct(
        private readonly CustomerAddressId $id,
        private readonly CountryId $countryId,
        private readonly CustomerId $customerId,
        private readonly CustomerAddressRegion $region,
        private readonly CustomerAddressCity $city,
        private readonly CustomerAddressPostalCode $postalCode,
        private readonly CustomerAddressStreetSuffix $streetSuffix,
        private readonly CustomerAddressStreet $street,
        private readonly CustomerAddressStreetNumber $streetNumber,
        private readonly CustomerAddressTelephone $telephone
    )
    {
    }

    public function id(): CustomerAddressId
    {
        return $this->id;
    }

    public function countryId(): CountryId
    {
        return $this->countryId;
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function region(): CustomerAddressRegion
    {
        return $this->region;
    }

    public function city(): CustomerAddressCity
    {
        return $this->city;
    }

    public function postalCode(): CustomerAddressPostalCode
    {
        return $this->postalCode;
    }

    public function streetSuffix(): CustomerAddressStreetSuffix
    {
        return $this->streetSuffix;
    }

    public function street(): CustomerAddressStreet
    {
        return $this->street;
    }

    public function streetNumber(): CustomerAddressStreetNumber
    {
        return $this->streetNumber;
    }

    public function telephone(): CustomerAddressTelephone
    {
        return $this->telephone;
    }

    public static function create(
        CustomerId $id,
        CustomerAddressRegion $region,
        CustomerAddressCity $city,
        CustomerAddressPostalCode $postalCode,
        CustomerAddressStreetSuffix $streetSuffix,
        CustomerAddressStreet $street,
        CustomerAddressStreetNumber $streetNumber,
        CustomerAddressTelephone $telephone
    ): self
    {
        return new self($id, $region, $city, $postalCode, $streetSuffix, $street, $streetNumber, $telephone);
    }

}