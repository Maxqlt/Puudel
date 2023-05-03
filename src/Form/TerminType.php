<?php

namespace App\Form;

use DateTime;
use DateTimeZone;
use App\Entity\Termin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TerminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('date', DateTimeType::class, [
                'date_label' => 'Starts On',
                'label' => 'Termin',
                'attr' => ['class' => 'btn btn-light p-2 m-1'],
                'date_widget' => 'choice',
                'data' => new DateTime('now', new DateTimeZone($_COOKIE['timezone'] ?? 'UTC')),
                'years' => range(date('Y'), date('Y') + 5),
                'row_attr' => ['class' => 'col-12'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Termin::class,
        ]);
    }
}
