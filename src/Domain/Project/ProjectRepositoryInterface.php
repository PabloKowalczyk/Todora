<?php

declare(strict_types=1);

namespace Todora\Domain\Project;

use Ramsey\Uuid\UuidInterface;
use Todora\Domain\Project;

interface ProjectRepositoryInterface
{
    public function add(Project $project);

    public function getProject(UuidInterface $id): Project;
}
