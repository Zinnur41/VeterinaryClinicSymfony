<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class PetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Фото питомца',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Пожалуйста, загрузите изображение в формате JPEG, PNG или GIF',
                    ]),
                ],
            ])
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
            ->add('weight', NumberType::class, [
                'label' => 'Вес в кг'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Добавить',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }
}