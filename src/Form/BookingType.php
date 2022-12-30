<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Timeslots;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig\EntityListeners\EntityConfig;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // 'attr' => [
                //     'min' => (new \DateTime())->format('Y-m-d'),
                //     'max' => (new \DateTime('+1 month'))->format('Y-m-d'),
                // ],
                'mapped' => false,
            ])
            // ->add('hour', ChoiceType::class)
            ->add('hour', EntityType::class, [
                'class' => Timeslots::class,
                'choice_label' => 'getStart',
                'mapped' => false,
            ])
            ->add('nbrOfPerson', IntegerType::class, [
                "attr" => [
                    "min" => 1,
                    "max" => 10
                ]
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('phone')
            ->add('allergies');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
