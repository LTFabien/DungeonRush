<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 20:56
 */

namespace App\Controller;



use App\Entity\Armor;
use App\Entity\Consumables;
use App\Entity\Move;
use App\Entity\Team;
use App\Entity\Weapons;
use App\Repository\ConsumablesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MarchandController extends AbstractController
{


    /**
     * @Route("/marchand", name="marchand")
     * @param ConsumablesRepository $consumablesRepository
     * @return Response
     */
    public function marchand(ConsumablesRepository $consumablesRepository): Response
    {
        $consumable=$consumablesRepository->findAll();
        $team=$this->getUser()->getTeam();
        return $this->render('pages/marchand.html.twig',array('team' => $team,'consumable'=>$consumable)); //faire passer les array en parametre
    }

    /**
     * @Route("/marchand/move/{id}/buy_move", name="buy_move")
     * @param Move $move
     * @return Response
     */

    public function buyMove(Move $move):Response
    {
        $team=$this->getUser()->getTeam();

        if($team->getMoney()>=$move->getPrice()&&$team->getLvl()>=$move->getLvl()){
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
     * @Route("/marchand/weapon/{id}/buy_weapon", name="buy_weapon")
     * @param  Weapons $weapons
     * @return Response
     */

    public function buyWeapon(Weapons $weapons):Response
    {
        $team=$this->getUser()->getTeam();

        if($team->getMoney()>=$weapons->getPrice()&&$team->getLvl()>=$weapons->getLvl()){
            $team->getInventory()->addWeapon($weapons);
            $team->setMoney(($team->getMoney())-($weapons->getPrice()));
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/armor/{id}/buy_armor", name="buy_armor")
     * @param Armor $armor
     * @return Response
     */
    public function buyArmor(Armor $armor):Response
    {
        $team=$this->getUser()->getTeam();

        if($team->getMoney()>=$armor->getPrice()&&$team->getLvl()>=$armor->getLvl()){
            $team->getInventory()->addArmor($armor);
            $team->setMoney(($team->getMoney())-($armor->getPrice()));
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/consumable/{id}/buy_consumable", name="buy_consumable")
     * @param Consumables $consumables
     * @return Response
     */
    public function buyConsumable(Consumables $consumables):Response
    {
        $team=$this->getUser()->getTeam();

        if($team->getMoney()>=$consumables->getPrice()){
            $team->getInventory()->addConsumable($consumables);
            $team->setMoney(($team->getMoney())-($consumables->getPrice()));
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }
}