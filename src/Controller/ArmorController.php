<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 04/04/2019
 * Time: 22:47
 */

namespace App\Controller;


use App\Entity\Armor;
use App\Form\ArmorType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArmorController  extends AbstractController
{
    /**
     * @Route("/admin/addArmor", name="addArmor")
     */

    public function addArmor(Request $request, ObjectManager $manager)
    {
        $armor = new Armor();
        $form= $this->createForm(ArmorType::class, $armor);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($armor);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addArmor.html.twig', [
            'formArmor' =>$form->createView()
        ]);

    }


}

{

}