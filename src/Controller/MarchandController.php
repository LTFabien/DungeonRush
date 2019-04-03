<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 20:56
 */

namespace App\Controller;



use App\Repository\ConsumablesRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarchandController extends AbstractController
{
    /**
     * @Route("/marchand", name="marchand")
     */
    public function marchand(TeamRepository $teamRepository,ConsumablesRepository $consumablesRepository): Response
    {
        $team=$teamRepository->findOneBy(['user' => $this->getUser()]);
        for ($i = 0; $i < 3; $i++) {
            dump($team->getCharacters()->get($i)->getClass()->getAuthorizedMove()->getValues()); //iterations sur les move authorise des joueur
            dump($team->getCharacters()->get($i)->getClass()->getAuthorizedArmors()->getValues()); //iterations sur les armures authorise des joueur
            dump($team->getCharacters()->get($i)->getClass()->getAuthorizedWeapons()->getValues()); //iterations sur les Armes authorise des joueur
        }
        dump($consumables=$consumablesRepository->findAll());

        return $this->render('pages/marchand.html.twig',array()); //faire passer les array en parametre
    }
}