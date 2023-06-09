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
                'choice_label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vote::class,
            'label' => false,
            'label_attr' => ['class' => ''], // disable the label rendering
            'attr' => ['class' => 'form-control'], // set the class attribute for the form element
        ]);
    }
}
