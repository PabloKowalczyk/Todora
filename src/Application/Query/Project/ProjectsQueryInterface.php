<?php

declare(strict_types=1);

namespace Todora\Application\Query\Project;

use Ramsey\Uuid\UuidInterface;

interface ProjectsQueryInterface
{
    public function findAll(): ProjectsView;

    public function getProject(UuidInterface $uuid): ProjectView;
}
