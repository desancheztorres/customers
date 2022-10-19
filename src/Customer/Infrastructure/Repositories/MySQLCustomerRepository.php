<?php

namespace Src\Customer\Infrastructure\Repositories;

use mysqli;
use Src\Customer\Domain\Contracts\CustomerRepository;
use Src\Customer\Domain\Customer;
use Src\CustomerAddress\CustomerAddress;

class MySQLCustomerRepository implements CustomerRepository
{
    public function __construct(private readonly mysqli $mysqli)
    {
    }

    public function save(Customer $customer): void
    {
        $id = $customer->id()->value();
        $firstname = $customer->firstName()->value();
        $lastName = $customer->lastName()->value();
        $email = $customer->email()->value();
        $password = $customer->password()->value();
        $birthday = $customer->birthday()->value();

        $stmt = $this->mysqli->prepare("INSERT INTO customers (id, first_name, last_name, email, password, birthday) VALUES (?,?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id,$firstname, $lastName, $email, $password, $birthday);
        $stmt->execute();
    }

    public function saveAddress(CustomerAddress $customerAddress): void
    {
        $id = $customerAddress->id()->value();
        $countryId = $customerAddress->countryId()->value();
        $customerId = $customerAddress->customerId()->value();
        $region = $customerAddress->region()->value();
        $city = $customerAddress->city()->value();
        $postal_code = $customerAddress->postalCode()->value();
        $street_suffix = $customerAddress->streetSuffix()->value();
        $street = $customerAddress->street()->value();
        $street_number = $customerAddress->streetNumber()->value();
        $telephone = $customerAddress->telephone()->value();

        $stmt = $this->mysqli->prepare("INSERT INTO customer_addresses (id, country_id, customer_id, region, city, postal_code, street_suffix, street, street_number, telephone) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $id,$countryId, $customerId, $region, $city, $postal_code, $street_suffix, $street, $street_number, $telephone);
        $stmt->execute();
    }
}