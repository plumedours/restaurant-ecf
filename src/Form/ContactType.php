<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                    'attr' => [
                        'minlenght' => '2',
                        'maxlenght' => '50',
                    ],
                    'label' => 'Prénom',
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ]
            )
            ->add('lastname', TextType::class, [
                    'attr' => [
                        'minlenght' => '2',
                        'maxlenght' => '50',
                    ],
                    'label' => 'Nom',
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ]
            )
            ->add('email', EmailType::class, [
                    'attr' => [
                        'minlenght' => '2',
                        'maxlenght' => '180',
                    ],
                    'label' => 'Adresse email',
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Email(),
                        new Assert\Length(['min' => 2, 'max' => 180])
                    ]
                ]
            )
            ->add('subject', TextType::class, [
                    'attr' => [
                        'minlenght' => '2',
                        'maxlenght' => '50',
                    ],
                    'label' => 'Sujet',
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ]
            )
            ->add('content', TextareaType::class, [
                    'label' => 'Message',
                    'constraints' => [
                        new Assert\NotBlank()
                    ]
                ]
            )
            ->add('submit', SubmitType::class, [
                    'attr' => [
                        'class' => 'focus:outline-none text-slate-50 bg-yellow-900 hover:bg-yellow-800 font-bold text-lg uppercase mt-5 w-32'
                    ],
                    'label' => 'Envoyer'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
