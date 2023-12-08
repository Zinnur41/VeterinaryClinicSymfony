<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Кличка'
            ])
            ->add('breed', TextType::class, [
                'label' => 'Порода'
            ])
            ->add('gender', TextType::class, [
                'label' => 'Пол'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Возраст'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Добавить',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }
}