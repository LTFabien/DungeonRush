<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:10
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddMonster extends AbstractController
{
    /**
     * @Route("/admin/addmonster", name="addmonster")
     */

    public function addMonster() {
        return $this->render('pages/addmonster.html.twig');
    }
}