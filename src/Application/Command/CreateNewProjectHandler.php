<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Todora\Domain\Project;
use Todora\Domain\Project\ProjectRepositoryInterface;

class CreateNewProjectHandler
{
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function handle(CreateNewProject $command): void
    {
        $project = Project::create($command->id(), $command->name());

        $this->projectRepository
            ->add($project);
    }
}
