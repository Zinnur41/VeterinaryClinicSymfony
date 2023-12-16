<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class ExaminationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', ChoiceType::class, [
                'choices' => [
                    'ул. Бигичева, д. 3' => 'ул. Бигичева, д. 3',
                    'ул. Ямашева, д. 73' => 'ул. Ямашева, д. 73'
                ]
            ])
            ->add('date', DateType::class);

    }
}