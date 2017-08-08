<?php

declare(strict_types=1);

namespace Todora\UserInterface\Web\Json\Project;

use Assert\Assertion;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;
use Todora\Application\Command\CreateNewProject;
use Todora\Application\Query\Project\ProjectsQueryInterface;
use Todora\Application\Service\ServerRequestExtractor;
use Zend\Diactoros\Response\JsonResponse;

class CreateNewProjectAction
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

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $requestData = $this->serverRequestExtractor
            ->fromJsonBody($request);

        Assertion::propertyExists($requestData, "projectName");

        $projectId = Uuid::uuid4();

        $command = new CreateNewProject($requestData->projectName, $projectId);

        $this->commandBus
            ->handle($command);

        $projectView = $this->projectsQuery
            ->getProject($projectId);

        return new JsonResponse($projectView);
    }
}
