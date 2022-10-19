<?php

declare(strict_types=1);

namespace Src\Country\Infrastructure\Repositories;

use mysqli;
use Src\Country\Country;
use Src\Country\Domain\Contracts\CountryRepository;
use Src\Country\Domain\ValueObject\CountryId;
use Src\Country\Domain\ValueObject\CountryName;

class MySQLCountryRepository implements CountryRepository
{
    public function __construct(private readonly mysqli $mysqli)
    {
    }

    public function save(Country $country): void
    {
        $id = $country->id()->value();
        $name = $country->name()->value();

        $stmt = $this->mysqli->prepare("INSERT INTO countries (id, name) VALUES (?, ?)");
        $stmt->bind_param("ss", $id,$name);
        $stmt->execute();
    }

    public function findByCriteria(CountryName $name): ?Country
    {
        $name = $name->value();

        $sql = "SELECT * FROM countries WHERE name=?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $country = $result->fetch_assoc();

        if (null === $country) {
            return null;
        }

        return new Country(
            new CountryId($country['id']),
            new CountryName($country['name']),
        );
    }
}