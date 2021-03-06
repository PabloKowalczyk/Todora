<?php

declare(strict_types=1);

namespace Todora\Todos\UserInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class BoardAction
{
    /**
     * @var EngineInterface
     */
    private $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function __invoke(): Response
    {
        return $this->engine
            ->renderResponse('todos/board.html.twig');
    }
}
