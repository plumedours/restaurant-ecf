<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', null, ['label' => 'Nom'])
        ->add('firstname', null, ['label' => 'Prénom'])
        ->add('phone', null, ['label' => 'Téléphone'])
        ->add('allergies', null, ['label' => 'Mes allergies'])
        ->add('plainPassword', PasswordType::class, [
            'label' => 'Veuillez entrer votre mot de passe afin de valider les changements.'
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'focus:outline-none text-slate-50 bg-yellow-900 hover:bg-yellow-800 font-bold text-lg uppercase mt-5 w-32'
            ],
            'label' => 'Envoyer'
        ]
    )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
