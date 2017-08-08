<?php

declare(strict_types=1);

namespace Todora\UserInterface\Web\Json\Project;

use Assert\Assert;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;
use Todora\Application\Command\RenameProject;
use Todora\Application\Query\Project\ProjectsQueryInterface;
use Todora\Application\Service\ServerRequestExtractor;
use Zend\Diactoros\Response\JsonResponse;

class RenameProjectAction
{
    /**
     * @var ServerRequestExtractor
     */
    private $serverRequestExtractor;
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var ProjectsQueryInterface
     */
    private $projectsQuery;

    public function __construct(
        ServerRequestExtractor $serverRequestExtractor,
        CommandBus $commandBus,
        ProjectsQueryInterface $projectsQuery
    ) {
        $this->serverRequestExtractor = $serverRequestExtractor;
        $this->commandBus = $commandBus;
        $this->projectsQuery = $projectsQuery;
    }

    public function __invoke(ServerRequestInterface $serverRequest): ResponseInterface
    {
        $requestData = $this->serverRequestExtractor
            ->fromJsonBody($serverRequest);

        Assert::that($requestData)
            ->propertyExists("projectId")
            ->propertyExists("projectNewName");

        $projectId = Uuid::fromString($requestData->projectId);
        $projectNewName = $requestData->projectNewName;

        $command = new RenameProject($projectId, $projectNewName);

        $this->commandBus
            ->handle($command);

        $projectView = $this->projectsQuery
            ->getProject($projectId);

        return new JsonResponse($projectView);
    }
}
