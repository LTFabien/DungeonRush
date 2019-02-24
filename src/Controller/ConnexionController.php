<?php
/**
 * Created by PhpStorm.
 * User: Fabien
 * Date: 19/02/2019
 * Time: 18:15
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionController extends AbstractController
{

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(): Response
    {
        return $this->render('pages/connexion.html.twig');
    }
}