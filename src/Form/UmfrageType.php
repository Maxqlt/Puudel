<?php

namespace App\Form;

use App\Entity\Umfrage;
use App\Form\TerminType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UmfrageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => '* Dein Name:',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', null, [
                'label' => '* Deine E-Mail:',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a valid email!',
                    ]),
                    new Email(),
                ],
            ])
            ->add('title', null, [
                'label' => '* Titel:',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Title!',
                    ]),
                    new Length(['min' => 2, 'max' => 50]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Beschreibung (optional):',
                'attr' => ['class' => 'form-control'],
                'required' => false,
                'constraints' => [ 
                    new NotBlank([
                        'message' => 'Please enter a description', // customize the error message
                        'allowNull' => true, // allow null values
                    ]),
                ],
            ])            
            ->add('private', null, [
                'label' => 'Umfrage privat: (Nur mit Link erreichbar)',
                'attr' => ['class' => 'form-control'],
                'data' => false,
            ])
            ->add('termins', CollectionType::class, [
                'label' => 'Termine:',
                'attr' => ['class' => 'form-control'],
                'entry_type' => TerminType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'no termin',
                    ]),
                ],
            ])
            
            ->add('save', SubmitType::class, [
                'label' => 'Umfrage erstellen',
                'attr' => ['class' => 'btn btn-success btn-lg '],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Umfrage::class,
        ]);
    }
}
