<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 20:56
 */

namespace App\Controller;


use App\Repository\ArmorRepository;
use App\Repository\ConsumablesRepository;
use App\Repository\MoveRepository;
use App\Repository\TeamRepository;
use App\Repository\WeaponsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarchandController extends AbstractController
{
    /**
     * @Route("/marchand", name="marchand")
     */
    public function marchand(MoveRepository $moveRepository,ArmorRepository $armorRepository, WeaponsRepository $weaponsRepository,TeamRepository $teamRepository,ConsumablesRepository $consumablesRepository): Response
    {
        $team=$teamRepository->findOneBy(['user' => $this->getUser()]);
        dump($moves=$moveRepository->findByLevel($team->getLvl()));
        dump($weapons=$weaponsRepository->findByLevel($team->getLvl()));
        dump($armors=$armorRepository->findByLevel($team->getLvl()));
        dump($consumables=$consumablesRepository->findAll());

        return $this->render('pages/marchand.html.twig',array());
    }
}