<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\CharacterClass;
use App\Entity\Move;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('HPmax')
            ->add('HP')
            ->add('MPmax')
            ->add('MP')
            ->add('Strength')
            ->add('Intelligence')
            ->add('Spirit')
            ->add('Vitality')
            ->add('Speed')
            ->add('class', EntityType::class, array(
                'class'        => CharacterClass::class,
                'choice_label' => 'name',
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
            'data_class' => Player::class,
        ]);
    }
}
