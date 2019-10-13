<?php

declare(strict_types=1);

namespace Todora\Todos\Application\Response;

final class TemplateResponse
{
    /** @var string */
    private $templateName;
    /** @var array */
    private $params;

    public function __construct(string $templateName, array $params = [])
    {
        $this->templateName = $templateName;
        $this->params = $params;
    }

    public function templateName(): string
    {
        return $this->templateName;
    }

    public function params(): array
    {
        return $this->params;
    }
}
