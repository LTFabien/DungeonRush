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


}
