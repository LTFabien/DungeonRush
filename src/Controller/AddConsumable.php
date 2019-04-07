<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 26/03/2019
 * Time: 14:27
 */

namespace App\Controller;


use App\Entity\Consumables;
use App\Form\ConsumablesType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddConsumable extends AbstractController
{
    /**
     * @Route("/admin/addConsumable", name="addConsumable")
     */

    public function addConsumable(Request $request, ObjectManager $manager)
    {
        $consumable = new Consumables();
        $form= $this->createForm(ConsumablesType::class, $consumable);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($consumable);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addConsumable.html.twig', [
            'formConsumable' =>$form->createView()
        ]);

    }

    /**
     * @Route("/showConsumables", name="ShowConsumables")
     */

    public function ShowConsumables():Response
    {
        $consumables = $this->getDoctrine()
            ->getRepository(Consumables::class)
            ->findAll();

        return $this->render('pages/Objects/showConsumables.html.twig', array('consumables' => $consumables));
    }

    /**
     * @Route("/edit/{id}/editConsumable", name="editConsumable")
     */
    public function editConsumable(Consumables $consumables, Request $request, ObjectManager $manager){

        $form = $this->createForm(ConsumablesType::class, $consumables);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($consumables);
            $manager->flush();
            return $this->redirectToRoute('ShowConsumables');
        }

        return $this->render('pages/addConsumable.html.twig', [
            'formConsumable' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}/deleteConsumable", name="deleteConsumable")
     */
    public function deleteConsumable(Consumables $consumables){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($consumables);
        $entityManager->flush();
        return $this->redirectToRoute('ShowConsumables');

    }
}
