<?php

declare(strict_types=1);

namespace Todora\Todos\Application\Service;

interface TemplatingServiceInterface
{
    public function render(string $templateName, array $params = []): string;
}
