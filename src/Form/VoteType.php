<?php

namespace App\Form;

use App\Entity\Vote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('answer', ChoiceType::class, 
            [   
                'choices' => [
                    'y' => 'yes',
                    'n' => 'maybe',
                    'm' => 'no',
                ],
                'expanded' => true,
                'label' => false,
                'label_attr' => [],
                'choice_label' => false,
                'choice_attr' => [
                    'yes' => ['class' => 'btn btn-outline-success'],
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vote::class,
        ]);
    }
}
