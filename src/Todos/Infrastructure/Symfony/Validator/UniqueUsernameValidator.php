<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Todora\Todos\Application\Query\UniqueUsernameQueryInterface;

class UniqueUsernameValidator extends ConstraintValidator
{
    /** @var UniqueUsernameQueryInterface */
    private $uniqueUsernameQuery;

    public function __construct(UniqueUsernameQueryInterface $uniqueUsernameQuery)
    {
        $this->uniqueUsernameQuery = $uniqueUsernameQuery;
    }

    /**
     * {@inheritdoc}
     *
     * @param UniqueUsername $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if (empty($value) || !\is_string($value)) {
            return;
        }

        $uniqueUsernameView = $this->uniqueUsernameQuery
            ->execute($value);

        if ($uniqueUsernameView->isUnique()) {
            return;
        }

        $violation = $this->context
            ->buildViolation($constraint->message);

        $violation->addViolation();
    }
}
