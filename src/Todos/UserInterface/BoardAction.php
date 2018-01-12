<?php

declare(strict_types=1);

namespace Todora\Todos\UserInterface;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Templating\EngineInterface;
use Zend\Diactoros\Response\HtmlResponse;

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

    public function __invoke(): ResponseInterface
    {
        $content = $this->engine
            ->render('todos/board.html.twig');

        return new HtmlResponse($content);
    }
}
