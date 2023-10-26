<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Weather;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class WeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
            ->add('temperature', NumberType::class)
            ->add('humidity', NumberType::class)
            ->add('precipitation', NumberType::class)
            ->add('windDirection', NumberType::class)
            ->add('windSpeed', NumberType::class)
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name'
            ])
            ->add('weatherType', EntityType::class, [
                'class' => \App\Entity\WeatherType::class,
                'choice_label' => "precipitation_type"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weather::class,
        ]);
    }
}
