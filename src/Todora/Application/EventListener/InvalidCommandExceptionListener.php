<?php

declare(strict_types=1);

namespace Todora\Application\EventListener;

use League\Tactician\Bundle\Middleware\InvalidCommandException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Validator\ConstraintViolation;

class InvalidCommandExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        if (!($exception instanceof InvalidCommandException)) {
            return;
        }

        $messages = [];
        $violations = $exception->getViolations();

        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $messages[] = [$violation->getPropertyPath() => $violation->getMessage()];
        }

        $response = new JsonResponse(
            ["errors" => $messages],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );

        $event->setResponse($response);
    }
}
