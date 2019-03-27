<?php

namespace App\Form;

use App\Entity\Consumables;
use App\Entity\Inventory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsumablesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('stat_buffed')
            ->add('number_buff')
            ->add('inventories', EntityType::class, array(
                'class'        => Inventory::class,
                'choice_label' => 'id',
                'multiple'     => true,
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consumables::class,
        ]);
    }
}
