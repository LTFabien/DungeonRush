<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\CharacterClass;
use App\Entity\Move;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type')
            ->add('description')
            ->add('class_authorized', EntityType::class, array(
                'class'        => CharacterClass::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->add('character_taught', CollectionType::class, [
                'entry_type' => Character::class,
                'entry_options' => ['label' => false],
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Move::class,
        ]);
    }
}
