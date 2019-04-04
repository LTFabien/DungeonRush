<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 20:56
 */

namespace App\Controller;



use App\Entity\Move;
use App\Repository\CharacterRepository;
use App\Repository\ConsumablesRepository;
use App\Repository\MoveRepository;
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
        $consumable=$consumablesRepository->findAll();

        return $this->render('pages/marchand.html.twig',array('team' => $team, 'consumable' => $consumable)); //faire passer les array en parametre
    }

    /**
     * @Route("/marchand/move/{id}/buy", name="buy")
     */
    public function buyMove(Move $move, TeamRepository $teamRepository)
    {
;
        //$entityManager = $this->getDoctrine()->getManager();
        //$entityManager->getCharacters()->get(0)->addMove($move);

        return $this->redirectToRoute('pages/marchand.html.twig');
    }
}