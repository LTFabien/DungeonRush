<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\CharacterClass;
use App\Entity\Group;
use App\Entity\Move;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('HPMax')
            ->add('HP')
            ->add('MPMax')
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
            ->add('move_learned', EntityType::class, array(
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
            'data_class' => Character::class,
        ]);
    }
}
