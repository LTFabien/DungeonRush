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

class LoginController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */

    public function login() {
        return $this->render('pages/login.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
    }
}