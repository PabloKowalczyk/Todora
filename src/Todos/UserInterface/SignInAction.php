<?php

declare(strict_types=1);

namespace Todora\Todos\UserInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Todora\Todos\Application\Response\TemplateResponse;

final class SignInAction
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

    public function __invoke(): TemplateResponse
    {
        $error = $this->authenticationUtils
            ->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils
            ->getLastUsername();

        return new TemplateResponse(
            'pages/login.html.twig',
            [
                'lastUsername' => $lastUsername,
                'error' => $error,
            ]
        );
    }
}
