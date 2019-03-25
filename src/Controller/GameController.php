<?php
/**
 * Created by PhpStorm.
 * User: Fabien
 * Date: 25/03/2019
 * Time: 10:56
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function play(): Response
    {

        return $this->render('pages/game.html.twig');
    }

}