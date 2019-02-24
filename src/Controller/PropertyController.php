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

class PropertyController extends AbstractController
{

    /**
     * @Route("/monstres", name="property.index")
     */
    public function index(): Response
    {
        return $this->render('property/index.html.twig', [ 'current_menu' => 'properties']);

    }
}