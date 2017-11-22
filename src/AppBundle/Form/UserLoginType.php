<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', null, ['label' => 'Prihlasovacie meno'])
            ->add('_password', PasswordType::class, ['label' => 'Heslo'])
            ->add('_remember_me', CheckboxType::class, ['required' => false, 'label' => 'Zapamätať si ma'])
            ->add('login', SubmitType::class, ['label' => 'Prihlásiť sa']);

        return $builder;
    }

    public function getName()
    {
        return 'app_bundle_user_login_type';
    }
}
