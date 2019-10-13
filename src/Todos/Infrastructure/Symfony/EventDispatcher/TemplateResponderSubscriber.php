<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\EventDispatcher;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Todora\Todos\Application\Response\TemplateResponse;
use Todora\Todos\Application\Service\TemplatingServiceInterface;

final class TemplateResponderSubscriber implements EventSubscriberInterface
{
    /** @var TemplatingServiceInterface */
    private $templatingService;

    public function __construct(TemplatingServiceInterface $templatingService)
    {
        $this->templatingService = $templatingService;
    }

    /** {@inheritdoc} */
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::VIEW => ['templateResponse', 100]];
    }

    public function templateResponse(ViewEvent $viewEvent): void
    {
        $controllerResult = $viewEvent->getControllerResult();

        if (!($controllerResult instanceof TemplateResponse)) {
            return;
        }

        $content = $this->templatingService
            ->render($controllerResult->templateName(), $controllerResult->params())
        ;

        $viewEvent->setResponse(new Response($content));
    }
}
