<?php

namespace Src\Customer\Application\create;

class CreateCustomerRequest
{
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password,
        private readonly string $birthday,
        private readonly string $country,
        private readonly ?string $region,
        private readonly string $city,
        private readonly ?string $postal_code,
        private readonly string $street_suffix,
        private readonly string $street,
        private readonly string $street_number,
        private readonly ?string $telephone,
    )
    {
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function birthday(): string
    {
        return $this->birthday;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function region(): ?string
    {
        return $this->region;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function postalCode(): ?string
    {
        return $this->postal_code;
    }

    public function streetSuffix(): string
    {
        return $this->street_suffix;
    }

    public function street(): string
    {
        return $this->street;
    }

    public function streetNumber(): string
    {
        return (int) $this->street_number;
    }

    public function telephone(): ?string
    {
        return $this->telephone;
    }
}