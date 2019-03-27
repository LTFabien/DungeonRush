<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 24/03/2019
 * Time: 19:08
 */

namespace App\Controller;


use App\Entity\CharacterClass;
use App\Entity\Weapons;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddCharacterClass extends AbstractController
{
    /**
     * @Route("/admin/addCharacterClass", name="addCharacterClass")
     */

    public function addCharacterClass(Request $request, ObjectManager $manager)
    {
        $class = new CharacterClass();
        $form = $this->createFormBuilder($class)
            ->add('name')
            ->add('description', TextareaType::class)
            ->add('authorized_weapons', EntityType::class, array(
                'class'        => Weapons::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($class);
            $manager->flush();
            return $this->redirectToRoute('characterclass.index');
        }

        return $this->render('pages/addCharacterClass.html.twig', [
            'formClass' => $form->createView()
        ]);
    }
}