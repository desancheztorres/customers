<?php

namespace Src\Customer\Domain\Contracts;

use Src\Customer\Domain\Customer;
use Src\CustomerAddress\CustomerAddress;

interface CustomerRepository
{
    public function save(Customer $customer): void;
    public function saveAddress(CustomerAddress $customerAddress): void;
}