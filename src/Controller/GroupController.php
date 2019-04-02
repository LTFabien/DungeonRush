<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 29/03/2019
 * Time: 19:46
 */

namespace App\Controller;


use App\Entity\Inventory;
use App\Entity\Player;
use App\Entity\Team;
use App\Form\TeamType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    /**
     * @Route("/group", name="group")
     */

    public function addGroup(Request $request, ObjectManager $manager) {
        $group = new Team();
        $group->setMoney(100);
        $Player1 = new Player();
        $Player1->setHPmax(10);
        $Player1->setMP(10);
        $Player1->setMPmax(10);
        $Player1->setSpeed(10);
        $Player1->setSpirit(10);
        $Player1->setStrength(10);
        $Player1->setIntelligence(10);
        $Player1->setVitality(10);
        $group->getCharacters()->add($Player1);
        $Player2 = new Player();
        $Player2->setHPmax(10);
        $Player2->setMP(10);
        $Player2->setMPmax(10);
        $Player2->setSpeed(10);
        $Player2->setSpirit(10);
        $Player2->setStrength(10);
        $Player2->setIntelligence(10);
        $Player2->setVitality(10);
        $group->getCharacters()->add($Player2);
        $Player3 = new Player();
        $Player3->setHPmax(10);
        $Player3->setMP(10);
        $Player3->setMPmax(10);
        $Player3->setSpeed(10);
        $Player3->setSpirit(10);
        $Player3->setStrength(10);
        $Player3->setIntelligence(10);
        $Player3->setVitality(10);
        $group->getCharacters()->add($Player3);
        $inventory = new Inventory();
        $group->setInventory($inventory);
        $form = $this->createForm(TeamType::class, $group);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $manager->persist($inventory);
            $manager->persist($Player1);
            $manager->persist($Player2);
            $manager->persist($Player3);
            $manager->persist($group);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/group', [
            'formGroup' => $form->createView()
        ]);
    }
}