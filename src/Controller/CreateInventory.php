<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 27/03/2019
 * Time: 15:33
 */

namespace App\Controller;


use App\Entity\Inventory;
use App\Form\InentoryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateInventory extends AbstractController
{
    /**
     * @Route("/admin/createInventory", name="createInventory")
     */

    public function addConsumable(Request $request, ObjectManager $manager)
    {
        $inventory = new Inventory();
        $form= $this->createForm(InentoryType::class, $inventory);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($inventory);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/createInventory', [
            'formInventory' =>$form->createView()
        ]);

    }


}