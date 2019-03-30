<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 29/03/2019
 * Time: 19:46
 */

namespace App\Controller;


use App\Entity\Group;
use App\Entity\Team;
use App\Form\GroupType;
use App\Form\TeamType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    /**
     * @Route("/admin/group", name="group")
     */

    public function addGroup(Request $request, ObjectManager $manager) {
        $group = new Team();

        $form = $this->createForm(TeamType::class, $group);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($group);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/group', [
            'formGroup' => $form->createView()
        ]);
    }
}