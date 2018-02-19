<?php

declare(strict_types=1);

namespace Todora\Todos\Application\Query;

interface UniqueUsernameQueryInterface
{
    public function execute(string $username): UniqueUsernameView;
}
