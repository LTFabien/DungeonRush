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
use App\Entity\Stages;
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
        $group->setLvl(1);
        $Player1 = new Player();
        $group->getCharacters()->add($Player1);
        $Player2 = new Player();
        $group->getCharacters()->add($Player2);
        $Player3 = new Player();
        $group->getCharacters()->add($Player3);
        $inventory = new Inventory();
        $group->setInventory($inventory);
        $group->setUser($this->getUser());
        $form = $this->createForm(TeamType::class, $group);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

            $Player1->setStats($form->get('characters')->get(0)->getData()->getClass()->getStats());
            $Player2->setStats($form->get('characters')->get(1)->getData()->getClass()->getStats());
            $Player3->setStats($form->get('characters')->get(2)->getData()->getClass()->getStats());

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

    /**
     * @Route("/UserArea/{id}/stages", name="StageDetails")
     */

    public function ShowDetails($id){
        $stage = $this->getDoctrine()
            ->getRepository(Stages::class)
            ->find($id);

        if (!$stage) {
            throw $this->createNotFoundException(
                'Aucune stage trouvée pour cet id :( '.$id
            );
        }

        return $this->render('pages/classDetails', array('stage' => $stage));
    }


}