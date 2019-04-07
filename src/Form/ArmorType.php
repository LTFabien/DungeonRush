<?php

namespace App\Form;

use App\Entity\Armor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('defense')
            ->add('element', ChoiceType::class, [
                'choices'  => [
                    'Normal' => 'Normal',
                    'Feu' => 'Feu',
                    'Eau' => 'Eau',
                    'Plante' => 'Plante',
                    'Terre' => 'Terre',
                    'Electrique' => 'Electrique',
                    'Glace' => 'Glace',
                ],
            ])
            ->add('lvl')
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Armor::class,
        ]);
    }
}
