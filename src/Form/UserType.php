<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\VoteType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Name',
                'attr' => ['placeholder' => 'Neuer Name', 'class' => 'form-control'],
            ])
            ->add('votes', CollectionType::class, [
                'attr' => ['class' => 'form-control'],
                'entry_type' => VoteType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => false,
                'attr' => ['class' => 'btn btn-success'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
