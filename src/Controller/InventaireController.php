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
        $player=$team->getCharacters();

        $weapons=$team->getInventory()->getWeapons()->getValues();
        $consumables=$team->getInventory()->getConsumables()->getValues();
        $armors=$team->getInventory()->getArmors()->getValues();

        return $this->render('pages/inventory.html.twig',array('player' => $player,
            'weapons' => $weapons, 'consumables' => $consumables, 'armors' => $armors)); // les faires passez en parametre dans le twig
    }
}