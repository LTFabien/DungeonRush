<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:15
 */

namespace App\Controller;


use App\Entity\Weapons;
use App\Form\WeaponsType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $form = $this->createForm(WeaponsType::class, $weapon);

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

    /**
     * @Route("admin/showWeapons", name="ShowWeapons")
     */

    public function ShowWeapons():Response
    {
        $Weapons = $this->getDoctrine()
            ->getRepository(Weapons::class)
            ->findAll();

        return $this->render('pages/Objects/showWeapons.html.twig', array('Weapons' => $Weapons));
    }

    /**
     * @Route("admin/edit/{id}/editWeapon", name="editWeapon")
     */
    public function editWeapon(Weapons $weapon, Request $request, ObjectManager $manager){

        $form = $this->createForm(WeaponsType::class, $weapon);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($weapon);
            $manager->flush();
            return $this->redirectToRoute('ShowWeapons');
        }

        return $this->render('pages/addWeapon.html.twig', [
            'formWeapons' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/delete/{id}/deleteWeapon", name="deleteWeapon")
     */
    public function deleteWeapon(Weapons $weapons){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($weapons);
        $entityManager->flush();
        return $this->redirectToRoute('ShowWeapons');

    }
}

##         $form = $this->createFormBuilder($weapon)
##->add('name')
##    ->add('description', TextareaType::class)
##    ->add('class_authorized', EntityType::class, array(
##        'class'        => CharacterClass::class,
##        'choice_label' => 'name',
##        'multiple'     => true,
##        'expanded' => true,
##    ))
##    ->getForm();