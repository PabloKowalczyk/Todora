<?php

declare(strict_types=1);

namespace Todora\Todos\Domain\Model\User;

use Assert\Assert;
use Assert\Assertion;
use Todora\SharedKernel\Domain\TodoraId;
use Todora\Todos\Domain\Model\Timestamps;

class User
{
    /** @var TodoraId */
    private $id;
    /** @var string */
    private $email;
    /** @var string */
    private $password;
    /** @var Timestamps */
    private $timestamps;
    /** @var bool */
    private $verified = false;
    /** @var array */
    private $roles;
    /** @var string */
    private $username;

    private function __construct(
        TodoraId $id,
        string $email,
        string $password,
        string $username
    ) {
        Assertion::email($email);
        Assert::thatAll(
            [
                $email,
                $password,
                $username,
            ]
        )->betweenLength(1, 240);

        $this->email = $email;
        $this->password = $password;
        $this->timestamps = Timestamps::create();
        $this->roles = ['ROLE_USER'];
        $this->id = $id;
        $this->username = $username;
    }

    public static function create(
        TodoraId $id,
        string $email,
        string $password,
        string $username
    ): self {
        return new self(
            $id,
            $email,
            $password,
            $username
        );
    }

    public function verify(): void
    {
        $this->verified = true;

        $this->timestamps
            ->update()
        ;
    }
}
