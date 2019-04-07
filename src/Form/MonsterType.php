<?php

namespace App\Form;

use App\Entity\Monsters;
use App\Entity\Move;
use App\Entity\Stages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonsterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('HPmax')
            ->add('MPmax')
            ->add('Strength')
            ->add('Intelligence')
            ->add('Spirit')
            ->add('Vitality')
            ->add('Speed')
            ->add('Gold')
            ->add('Exp')
            ->add('stages', EntityType::class, array(
                'class'        => Stages::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->add('move', EntityType::class, array(
                'class'        => Move::class,
                'choice_label' => 'nom',
                'multiple'     => true,
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Monsters::class,
        ]);
    }
}
