<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 30/03/2019
 * Time: 23:03
 */

namespace App\Controller;


use App\Entity\Dungeons;
use App\Form\DungeonType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DungeonController extends AbstractController
{
    /**
     * @Route("/admin/addDungeon", name="addDungeon")
     */

    public function addDungeon(Request $request, ObjectManager $manager)
    {
        $dungeon = new Dungeons();
        $form= $this->createForm(DungeonType::class, $dungeon);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($dungeon);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addDungeon', [
            'formDungeon' =>$form->createView()
        ]);

    }

    /**
     * @Route("admin/showDungeons", name="ShowDungeons")
     */

    public function ShowDungeons():Response
    {
        $dungeon = $this->getDoctrine()
            ->getRepository(Dungeons::class)
            ->findAll();

        return $this->render('pages/Objects/showDungeons.html.twig', array('dungeons' => $dungeon));
    }

    /**
     * @Route("admin/edit/{id}/editDungeon", name="editDungeon")
     */
    public function editDungeon(Dungeons $dungeons, Request $request, ObjectManager $manager){

        $form = $this->createForm(DungeonType::class, $dungeons);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($dungeons);
            $manager->flush();
            return $this->redirectToRoute('ShowDungeons');
        }

        return $this->render('pages/addDungeon', [
            'formDungeon' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/delete/{id}/deleteDungeon", name="deleteDungeon")
     */
    public function deleteDungeon(Dungeons $dungeon){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($dungeon);
        $entityManager->flush();
        return $this->redirectToRoute('ShowDungeons');

    }
}
