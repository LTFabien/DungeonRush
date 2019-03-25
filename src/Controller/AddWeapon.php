<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:15
 */

namespace App\Controller;


use App\Entity\Weapons;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CharacterClass;
use Doctrine\ORM\Entity;

class AddWeapon extends AbstractController
{
    /**
     * @Route("/admin/addWeapon", name="addWeapon")
     */

    public function addWeapon(Request $request, ObjectManager $manager) {
        $weapon = new Weapons();
        $character_class = new CharacterClass();
        $form = $this->createFormBuilder($weapon)
            ->add('name')
            ->add('description', TextareaType::class)
            ->add('class_authorized', EntityType::class, array(
                'class'        => CharacterClass::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded' => true,
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($weapon);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addWeapon.html.twig', [
            'formWeapons' => $form->createView()
        ]);
    }
}