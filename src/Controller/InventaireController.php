<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 23:56
 */

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InventaireController extends AbstractController
{
    /**
     * @Route("/inventaire", name="inventaire")
     */
    public function inventory(TeamRepository $teamRepository): Response
    {
        $team=$teamRepository->findOneBy(['user' => $this->getUser()]);
        dump($team->getInventory()->getArmors()->getValues()); // Armures de L'inventaire
        dump($team->getInventory()->getConsumables()->getValues()); //Consomable de L'inventaire
        dump($team->getInventory()->getWeapons()->getValues());  //Armes de l'inventaire

        return $this->render('pages/inventory.html.twig',array()); // les faires passez en parametre dans le twig
    }
}