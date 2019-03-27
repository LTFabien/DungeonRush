<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
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
            ->add('class')
            ->add('move_learned')
            ->add('team')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
