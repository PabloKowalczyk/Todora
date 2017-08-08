<?php

declare(strict_types=1);

namespace Todora\UserInterface\Web\Json\Task;

use Assert\Assertion;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;
use Todora\Application\Command\CreateNewTask;
use Todora\Application\Query\Task\TasksQueryInterface;
use Todora\Application\Service\ServerRequestExtractor;
use Zend\Diactoros\Response\JsonResponse;

class CreateNewTaskAction
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
     * @var TasksQueryInterface
     */
    private $tasksQuery;

    public function __construct(
        ServerRequestExtractor $serverRequestExtractor,
        CommandBus $commandBus,
        TasksQueryInterface $tasksQuery
    ) {
        $this->serverRequestExtractor = $serverRequestExtractor;
        $this->commandBus = $commandBus;
        $this->tasksQuery = $tasksQuery;
    }

    public function __invoke(ServerRequestInterface $serverRequest): ResponseInterface
    {
        $requestData = $this->serverRequestExtractor
            ->fromJsonBody($serverRequest);

        Assertion::propertyExists($requestData, "description");
        Assertion::propertyExists($requestData, "projectId");

        $taskId = Uuid::uuid4();

        $command = new CreateNewTask(
            $taskId,
            $requestData->description,
            $requestData->projectId
        );

        $this->commandBus
            ->handle($command);

        $taskView = $this->tasksQuery
            ->getTask($taskId);

        return new JsonResponse($taskView);
    }
}
