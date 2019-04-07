<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 31/03/2019
 * Time: 23:59
 */

namespace App\Controller;


use App\Entity\Dungeons;
use App\Repository\DungeonsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserArea extends AbstractController
{
    /**
     * @Route("/UserArea", name="UserArea")
     */

    public function ShowDetails():Response
    {
        $team=$this->getUser()->getTeam();
        $dungeon = $this->getDoctrine()
            ->getRepository(Dungeons::class)
            ->findAll();

        return $this->render('pages/userArea', array('dungeons' => $dungeon, 'team' => $team));
    }

    /**
     * @Route("/Game/{id}", name="Game")
     * @param Dungeons $dungeons
     * @return Response
     */

    public function Play(Dungeons $dungeons):Response
    {
        $team=$this->getUser()->getTeam();
        return $this->render('pages/game.html.twig', array('dungeons' => $dungeons,'team'=>$team));
    }
}