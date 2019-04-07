<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\CharacterClass;
use App\Entity\Move;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('lvl')
            ->add('price')
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
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Physical' => 'Physical',
                    'Magical' => 'Magical']])
            ->add('description')
            ->add('class_authorized', EntityType::class, array(
                'class'        => CharacterClass::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->add('cost')
            ->add('puissance')

        ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Move::class,
        ]);
    }
}
