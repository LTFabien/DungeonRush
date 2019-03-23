<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:02
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddMember extends AbstractController
{

    /**
     * @Route("/admin/addmember", name="addmember")
     */

    public function addMember() {
        return $this->render('pages/addmember.html.twig');
    }

}