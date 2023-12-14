<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class ServiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service', TextType::class, [
                'label' => 'Название услуги'
            ])
            ->add('cost', IntegerType::class, [
                'label' => 'Стоимость'
            ])
            ->add('image', FileType::class, [
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Пожалуйста, загрузите изображение в формате JPEG, PNG или GIF',
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Добавить'
            ]);
    }
}