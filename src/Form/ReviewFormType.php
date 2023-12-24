<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       $builder
           ->add('score', ChoiceType::class, [
               'choices' => [
                   '⭐' => 1,
                   '⭐⭐' => 2,
                   '⭐⭐⭐' => 3,
                   '⭐⭐⭐⭐' => 4,
                   '⭐⭐⭐⭐⭐' => 5
               ],
               'label' => 'Поставьте оценку',
               'attr' => [
                   'style' => 'width: 160px'
               ]
           ])
           ->add('comment', TextareaType::class, [
               'label' => 'Оставьте отзыв'
           ])
           ->add('submit', SubmitType::class, [
               'attr' => [
                   'class' => 'btn btn-success'
               ],
               'label' => 'Оставить отзыв'
           ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'attr' => ['id' => 'review-id']
            ]);
    }
}