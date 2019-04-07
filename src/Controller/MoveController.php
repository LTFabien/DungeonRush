<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 29/03/2019
 * Time: 16:43
 */

namespace App\Controller;


use App\Entity\Move;
use App\Form\MoveType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoveController extends AbstractController
{
    /**
     * @Route("/admin/move", name="addMove")
     */

    public function addMove(Request $request, ObjectManager $manager) {
        $move = new Move();

        $form = $this->createForm(MoveType::class, $move);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($move);
            $manager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('pages/move', [
            'formMove' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/showMoves", name="ShowMoves")
     */

    public function ShowMoves():Response
    {
        $moves = $this->getDoctrine()
            ->getRepository(Move::class)
            ->findAll();

        return $this->render('pages/Objects/showMoves.html.twig', array('moves' => $moves));
    }

    /**
     * @Route("admin/edit/{id}/editMove", name="editMove")
     */
    public function editMove(Move $move, Request $request, ObjectManager $manager){

        $form = $this->createForm(MoveType::class, $move);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($move);
            $manager->flush();
            return $this->redirectToRoute('ShowMoves');
        }

        return $this->render('pages/move', [
            'formMove' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/delete/{id}/deleteMove", name="deleteMove")
     */
    public function deleteMove(Move $move){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($move);
        $entityManager->flush();
        return $this->redirectToRoute('ShowMoves');

    }
}