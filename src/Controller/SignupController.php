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


class SignupController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function inscription(): Response
    {
        return $this->render('pages/signup.html.twig');
    }
}