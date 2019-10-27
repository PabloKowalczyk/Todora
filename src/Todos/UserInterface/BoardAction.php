<?php

declare(strict_types=1);

namespace Todora\Todos\UserInterface;

use Todora\Todos\Application\Response\TemplateResponse;

final class BoardAction
{
    public function __invoke(): TemplateResponse
    {
        return new TemplateResponse('todos/board.html.twig');
    }
}
