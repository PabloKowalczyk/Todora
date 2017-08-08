<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Todora\Domain\Project\ProjectRepositoryInterface;

class RenameProjectHandler
{
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function handle(RenameProject $renameProject): void
    {
        $project = $this->projectRepository
            ->getProject($renameProject->projectId());

        $project->rename($renameProject->newName());
    }
}
