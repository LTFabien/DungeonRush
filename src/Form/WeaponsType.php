<?php

namespace App\Form;

use App\Entity\CharacterClass;
use App\Entity\Inventory;
use App\Entity\Weapons;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeaponsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('class_authorized', EntityType::class, array(
                'class'        => CharacterClass::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->add('inventories', EntityType::class, array(
                'class'        => Inventory::class,
                'choice_label' => 'id',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->add('damage')
            ->add('element')
            ->add('price')
            ->add('lvl')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Weapons::class,
        ]);
    }
}
