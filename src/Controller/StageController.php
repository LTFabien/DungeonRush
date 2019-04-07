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
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("admin/showStages", name="ShowStages")
     */

    public function ShowStages():Response
    {
        $stages = $this->getDoctrine()
            ->getRepository(Stages::class)
            ->findAll();

        return $this->render('pages/Objects/showStages.html.twig', array('stages' => $stages));
    }

    /**
     * @Route("admin/edit/{id}/editStage", name="editStage")
     */
    public function editStage(Stages $stages, Request $request, ObjectManager $manager){

        $form = $this->createForm(StageType::class, $stages);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($stages);
            $manager->flush();
            return $this->redirectToRoute('ShowStages');
        }

        return $this->render('pages/addStage', [
            'formStage' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/delete/{id}/deleteStages", name="deleteStage")
     */
    public function deleteStage(Stages $stages){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($stages);
        $entityManager->flush();
        return $this->redirectToRoute('ShowStages');

    }

}