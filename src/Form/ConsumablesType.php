<?php

namespace App\Form;

use App\Entity\Consumables;
use App\Entity\Inventory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsumablesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('stat', ChoiceType::class, [
                'choices'  => [
                    'HP' => 'HP',
                    'MP' => 'MP',
                    'Speed' => 'Speed',
                    'Spirit' => 'Spirit',
                    'Intelligence' => 'Intelligence',
                    'Vitality' => 'Vitality',
                    'Revive' => 'Revive',
                    'Strength' => 'Strength',
                ],
            ])
            ->add('number')
            ->add('turn')
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consumables::class,
        ]);
    }
}
