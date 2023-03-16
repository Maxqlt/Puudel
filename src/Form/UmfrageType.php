<?php

namespace App\Form;

use App\Entity\Umfrage;
use App\Form\TerminType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UmfrageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Dein Name:',
                'attr' => ['class' => 'form-control mb-3'],
            ])
            ->add('email', null, [
                'label' => 'Deine E-Mail:',
                'attr' => ['class' => 'form-control mb-3'],
            ])
            ->add('title', null, [
                'label' => 'Titel',
                'attr' => ['class' => 'form-control  mb-3'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Beschreibung',
                'attr' => ['class' => 'form-control  mb-3'],
            ])
            ->add('termins', CollectionType::class, [
                'label' => 'Termine',
                'attr' => ['class' => 'form-control mb-3'],
                'entry_type' => TerminType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Umfrage erstellen',
                'attr' => ['class' => 'btn btn-success btn-lg btn-block my-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Umfrage::class,
        ]);
    }
}
