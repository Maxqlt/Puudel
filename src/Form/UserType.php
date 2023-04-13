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
            ->add('name')
            ->add('votes', CollectionType::class, [
                'label' => 'Votes',
                'attr' => ['class' => 'form-control mb-3'],
                'entry_type' => VoteType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Votes Abschicken',
                'attr' => ['class' => 'btn btn-success btn-lg btn-block my-3'],
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