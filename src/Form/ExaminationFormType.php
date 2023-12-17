<?php

namespace App\Form;

use App\Entity\Pet;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

class ExaminationFormType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->addEventListener(FormEvents::PRE_SET_DATA, function (ExaminationFormType $examinationFormType) {

        });*/
        $user = $this->security->getUser();

        $builder
            ->add('pet', EntityType::class, [
                'class' => Pet::class,
                'choice_label' => 'name',
                'placeholder' => 'Выберите питомца',
                'label' => false,
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('p')
                        ->join('p.owner', 'o')
                        ->where('o.id = :user_id')
                        ->setParameter('user_id', $user->getId());
                },
            ])
            ->add('address', ChoiceType::class, [
                'choices' => [
                    'ул. Бигичева, д. 3' => 'ул. Бигичева, д. 3',
                    'ул. Ямашева, д. 73' => 'ул. Ямашева, д. 73'
                ],
                'label' => 'Адрес'
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Выберите дату',
                'attr' => ['class' => 'js-datetimepicker'],
                'hours' => range(8, 21),
                'years' => ['2023' => 2023],
                'minutes' => range(0, 45, 15),
                'widget' => 'choice'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Записаться'
            ]);

    }
}