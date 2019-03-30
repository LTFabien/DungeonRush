<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 26/03/2019
 * Time: 11:08
 */

namespace App\Controller;


use App\Entity\Player;
use App\Form\CharacterType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddCharacter extends AbstractController
{
    /**
     * @Route("/admin/addCharacter", name="addCharacter")
     */

    public function addCharacter(Request $request, ObjectManager $manager) {
        $character = new Player();

        $form = $this->createForm(CharacterType::class, $character);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($character);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addCharacter.html.twig', [
            'formCharacter' => $form->createView()
        ]);
    }
}