<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'username',
                TextType::class,
                ['required' => false]
            )
            ->add(
                'email',
                EmailType::class,
                ['required' => false]
            )
            ->add(
                'password',
                PasswordType::class,
                ['required' => false]
            )
            ->add(
                'repeatPassword',
                PasswordType::class,
                ['required' => false]
            )
        ;
    }
}
