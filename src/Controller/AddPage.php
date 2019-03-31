<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 30/03/2019
 * Time: 23:32
 */

namespace App\Controller;


use App\Entity\Weapons;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddPage extends AbstractController
{

    /**
     * @Route("/admin/Add", name="add")
     */
    public function homepage(): Response
    {
        return $this->render('pages/ajouter');
    }
}