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
     * @Route("/addCharacter", name="addCharacter")
     */

    public function addCharacter(Request $request, ObjectManager $manager) {
        $character = new Player();

        $character->setHP(10);
        $character->setHPmax(10);
        $character->setMP(10);
        $character->setMPmax(10);
        $character->setSpeed(10);
        $character->setSpirit(10);
        $character->setStrength(10);
        $character->setIntelligence(10);
        $character->setVitality(10);
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