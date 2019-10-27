<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Twig;

use Todora\Todos\Application\Service\TemplatingServiceInterface;
use Twig\Environment;

final class TwigTemplatingService implements TemplatingServiceInterface
{
    /** @var Environment */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(string $templateName, array $params = []): string
    {
        return $this->twig
            ->render($templateName, $params)
        ;
    }
}
