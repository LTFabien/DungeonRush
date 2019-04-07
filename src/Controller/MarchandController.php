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
use App\Entity\InventoryArmor;
use App\Entity\InventoryConsumables;
use App\Entity\InventoryWeapons;
use App\Entity\Move;
use App\Entity\Team;
use App\Entity\Weapons;
use App\Repository\ConsumablesRepository;
use App\Repository\InventoryConsumablesRepository;
use App\Repository\InventoryWeaponsRepository;
use App\Repository\InventoryArmorRepository;
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
    public function marchand(ConsumablesRepository $consumablesRepository,InventoryConsumablesRepository $inventoryConsumablesRepository): Response
    {
        $consumable=$consumablesRepository->findAll();
        $team=$this->getUser()->getTeam();
        dump($inventoryConsumablesRepository->findOneBy(array('inventory'=>$team->getInventory(),'consumables'=>$consumable)));
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

    public function buyWeapon(Weapons $weapons,InventoryWeaponsRepository $inventoryWeapons):Response
    {
        $team=$this->getUser()->getTeam();
        $entityManager = $this->getDoctrine()->getManager();
        $index=($inventoryWeapons->findOneBy(array('inventory'=>$team->getInventory(),'weapons'=>$weapons)));

        if($team->getMoney()>=$weapons->getPrice()){
            if($index==null) {
                $team->getInventory()->addWeapon($weapons);
            }else{
                $index->setQuantite($index->getQuantite()+1);
            }
        }
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/armor/{id}/buy_armor", name="buy_armor")
     * @param Armor $armor
     * @return Response
     */
    public function buyArmor(Armor $armor,InventoryArmorRepository $inventoryArmor):Response
    {
        $team=$this->getUser()->getTeam();
        $entityManager = $this->getDoctrine()->getManager();
        $index=($inventoryArmor->findOneBy(array('inventory'=>$team->getInventory(),'armor'=>$armor)));

        if($team->getMoney()>=$armor->getPrice()){
            if($index==null) {
                $team->getInventory()->addArmor($armor);
            }else{
                $index->setQuantite($index->getQuantite()+1);
            }
        }
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }

    /**
     * @Route("/marchand/consumable/{id}/buy_consumable", name="buy_consumable")
     * @param Consumables $consumables
     * @return Response
     */
    public function buyConsumable(Consumables $consumables,InventoryConsumablesRepository $consumablesRepository):Response
    {
        $team=$this->getUser()->getTeam();
        $entityManager = $this->getDoctrine()->getManager();

        $index=($consumablesRepository->findOneBy(array('inventory'=>$team->getInventory(),'consumables'=>$consumables)));
        if($team->getMoney()>=$consumables->getPrice()){
            if($index==null) {
                $team->getInventory()->addConsumable($consumables);
            }else{
                $index->setQuantite($index->getQuantite()+1);
            }
        }
        $entityManager->flush();

        return $this->redirectToRoute('marchand');
    }
}