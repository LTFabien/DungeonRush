<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 20:56
 */

namespace App\Controller;



use App\Entity\Move;
use App\Entity\Team;
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
        $consumable=$consumablesRepository->findAll();
        $team=$teamRepository->findOneBy(['user' => $this->getUser()]);


        return $this->render('pages/marchand.html.twig',array('team' => $team,'consumable'=>$consumable)); //faire passer les array en parametre
    }

    /**
     * @Route("/marchand/move/{id}/buy_move/{team}", name="buy_move")
     *
     */
    public function buyMove(Move $move,Team $team)
    {
        if($team->getMoney()>=$move->getPrice()){
            foreach ($team->getCharacters() as $character)
            if ($character->getClass()->getAuthorizedMove()->contains($move)){
                $character->addMove($move);
            };
            $team->setMoney(($team->getMoney())-($move->getPrice()));
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/weapon/{id}/buy_weapon/{team}", name="buy_weapon")
     *
     */
    public function buyWeapon(Move $move,Team $team)
    {
        if($team->getMoney()>=$move->getPrice()){
            foreach ($team->getCharacters() as $character)
                if ($character->getClass()->getAuthorizedMove()->contains($move)){
                    $character->addMove($move);
                };
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/armor/{id}/buy_armor/{team}", name="buy_armor")
     *
     */
    public function buyArmor(Move $move,Team $team)
    {
        if($team->getMoney()>=$move->getPrice()){
            foreach ($team->getCharacters() as $character){
                if ($character->getClass()->getAuthorizedMove()->contains($move)){
                    $character->addMove($move);
                };
            }
            $team->setMoney(($team->getMoney())-($move->getPrice()));
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/consumable/{id}/buy_consumable/{team}", name="buy_consumable")
     *
     */
    public function buyConsumable(Move $move,Team $team)
    {
        if($team->getMoney()>=$move->getPrice()){
            foreach ($team->getCharacters() as $character)
                if ($character->getClass()->getAuthorizedMove()->contains($move)){
                    $character->addMove($move);
                };
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }
}