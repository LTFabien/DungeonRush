<?php

namespace App\Form;

use App\Entity\Dungeons;
use App\Entity\Monsters;
use App\Entity\Stages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('Monster', EntityType::class, array(
                'class'        => Monsters::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->add('dungeons', EntityType::class, array(
                'class'        => Dungeons::class,
                'choice_label' => 'name',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stages::class,
        ]);
    }
}
