<?php

declare(strict_types=1);

namespace Todora\Todos\Application\Command\RegisterUser;

use Todora\SharedKernel\Application\ApplicationException;

class PasswordsDoNotMatchException extends ApplicationException
{
    public static function create(): self
    {
        return new self('Passed passwords are not same.');
    }
}
