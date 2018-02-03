<?php

declare(strict_types=1);

namespace Todora\Todos\UserInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SignInAction
{
    /**
     * @var EngineInterface
     */
    private $templateRenderer;
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    public function __construct(EngineInterface $templateRenderer, AuthenticationUtils $authenticationUtils)
    {
        $this->templateRenderer = $templateRenderer;
        $this->authenticationUtils = $authenticationUtils;
    }

    public function __invoke(): Response
    {
        $error = $this->authenticationUtils
            ->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils
            ->getLastUsername();

        return $this->templateRenderer
            ->renderResponse(
                'pages/login.html.twig',
                [
                    'lastUsername' => $lastUsername,
                    'error' => $error,
                ]
            );
    }
}
