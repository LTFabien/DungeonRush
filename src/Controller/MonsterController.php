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
use Symfony\Component\HttpFoundation\Response;
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
            $monster->setHP($form->get('HPmax')->getData());
            $monster->setMP($form->get('MPmax')->getData());
            $manager->persist($monster);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addMonster', [
            'formMonster' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/showMonsters", name="ShowMonsters")
     */
    public function ShowMonsters():Response
    {
        $monsters = $this->getDoctrine()
            ->getRepository(Monsters::class)
            ->findAll();

        return $this->render('pages/Objects/showMonsters.html.twig', array('monsters' => $monsters));
    }

    /**
     * @Route("admin/edit/{id}/editMonster", name="editMonster")
     */
    public function editMonster(Monsters $monster, Request $request, ObjectManager $manager){

        $form = $this->createForm(MonsterType::class, $monster);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $monster->setHP($form->get('HPmax')->getData());
            $monster->setMP($form->get('MPmax')->getData());
            $manager->persist($monster);
            $manager->flush();
            return $this->redirectToRoute('ShowMonsters');
        }

        return $this->render('pages/addMonster', [
            'formMonster' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/delete/{id}/deleteMonster", name="deleteMonster")
     */
    public function deleteMonster(Monsters $monsters){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($monsters);
        $entityManager->flush();
        return $this->redirectToRoute('ShowMonsters');

    }
}