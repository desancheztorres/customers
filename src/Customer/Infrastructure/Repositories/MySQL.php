<?php

namespace Src\Customer\Infrastructure\Repositories;

use mysqli;

class MySQL
{
    private readonly mysqli $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli("database", "cristian", "secret", "arcmedia");
    }
}