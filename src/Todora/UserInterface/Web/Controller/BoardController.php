<?php

declare(strict_types=1);

namespace Todora\UserInterface\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Todora\Application\Query\Project\ProjectsQueryInterface;

class BoardController
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;
    /**
     * @var ProjectsQueryInterface
     */
    private $projectsQuery;

    public function __construct(EngineInterface $templateEngine, ProjectsQueryInterface $projectsQuery)
    {
        $this->templateEngine = $templateEngine;
        $this->projectsQuery = $projectsQuery;
    }

    public function indexAction(): Response
    {
        return $this->templateEngine
            ->renderResponse(
                "@Todora/Board/index.html.twig",
                [
                    "projects" => $this->projectsQuery
                        ->findAll()
                        ->getProjectViews()
                ]
            );
    }
}
