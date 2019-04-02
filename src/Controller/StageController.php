<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 30/03/2019
 * Time: 23:11
 */

namespace App\Controller;


use App\Entity\Stages;
use App\Form\StageType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StageController extends AbstractController
{
    /**
     * @Route("/admin/addStage", name="addStage")
     */

    public function addStage(Request $request, ObjectManager $manager) {
        $stage = new Stages();

        $form = $this->createForm(StageType::class, $stage);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($stage);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addStage', [
            'formStage' => $form->createView()
        ]);
    }



}