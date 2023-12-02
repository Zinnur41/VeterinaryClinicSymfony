<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("firstName", TextType::class)
            ->add("secondName", TextType::class)
            ->add("thirdName", TextType::class)
            ->add("email", EmailType::class)
            ->add("password", PasswordType::class)
            ->add("phoneNumber", TextType::class)
            ->add("submit", SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
    }
}