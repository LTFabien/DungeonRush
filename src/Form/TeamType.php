<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Inventory;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('Money')
            ->add('Inventory', EntityType::class, array(
                'class'        => Inventory::class,
                'choice_label' => 'id',
            ))
            ->add('characters', EntityType::class, array(
                'class'        => Player::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
