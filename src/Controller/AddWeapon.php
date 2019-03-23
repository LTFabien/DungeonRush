<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:15
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddWeapon extends AbstractController
{
    /**
     * @Route("/admin/addweapon", name="addweapon")
     */

    public function addWeapon() {
        return $this->render('pages/addweapon.html.twig');
    }
}