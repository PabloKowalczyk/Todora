<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\Validator;

use Symfony\Component\Validator\Constraint;

class UniqueUsername extends Constraint
{
    public $message = 'This username is not unique. Try other.';
}
