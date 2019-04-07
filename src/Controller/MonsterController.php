<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 30/03/2019
 * Time: 22:51
 */

namespace App\Controller;


use App\Entity\Monsters;
use App\Form\MonsterType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MonsterController extends AbstractController
{
    /**
     * @Route("/admin/addMonster", name="addMonster")
     */

    public function addMonster(Request $request, ObjectManager $manager) {
        $monster = new Monsters();

        $form = $this->createForm(MonsterType::class, $monster);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($monster);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addMonster', [
            'formMonster' => $form->createView()
        ]);
    }
}