<?php

declare(strict_types=1);

namespace Todora\Application\Query\Project;

class ProjectsView
{
    /**
     * @var ProjectView[]
     */
    private $projectViews;

    public function __construct(ProjectView ...$projectViews)
    {
        $this->projectViews = $projectViews;
    }

    /**
     * @return ProjectView[]
     */
    public function getProjectViews(): array
    {
        return $this->projectViews;
    }
}
