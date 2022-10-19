<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

use Src\Customer\Domain\Exceptions\CustomerInvalidEmail;

abstract class EmailValueObject
{
    private string $value;

    public function __construct(string $email)
    {
        $this->validate($email);
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function validate(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new CustomerInvalidEmail(
                sprintf('<%s> does not allow the invalid email: <%s>.', static::class, $email)
            );
        }
    }

}
