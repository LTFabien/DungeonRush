<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 23:56
 */

namespace App\Controller;

use App\Entity\Armor;
use App\Entity\Player;
use App\Entity\Weapons;
use App\Repository\InventoryArmorRepository;
use App\Repository\InventoryWeaponsRepository;
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

        return $this->render('pages/inventory.html.twig',array('team' => $team)); // les faires passez en parametre dans le twig
    }

    /**
     * @Route("/inventaire/{id}/equip_weapon/{playerid}", name="equip_weapon")
     */
    public function EquipWeapon(Weapons $weapons,InventoryWeaponsRepository $inventoryWeaponsRepository,Player $player): Response
    {
        $team=$this->getUser()->getTeam();
        $entityManager = $this->getDoctrine()->getManager();
        $NewWeapon=($inventoryWeaponsRepository->findOneBy(array('inventory'=>$team->getInventory(),'weapons'=>$weapons)));
        if($NewWeapon->getQuantite()>0){
            if(!$player->getWeapon()==null){
                $CurrentWeapon=($inventoryWeaponsRepository->findOneBy(array('inventory'=>$team->getInventory(),'weapons'=>$player->getWeapon())));
                $CurrentWeapon->setQuantite($CurrentWeapon->getQuantite()+1);
            }
            $player->setWeapon($weapons);
            $NewWeapon->setQuantite($NewWeapon->getQuantite()-1);
        }
        $entityManager->flush();
        return $this->redirectToRoute('inventaire');
    }

    /**
     * @Route("/inventaire/{id}/equip_weapon/{playerid}", name="equip_armor")
     */
    public function EquipArmor(Armor $armor,InventoryArmorRepository $inventoryArmorRepository,Player $player): Response
    {
        $team=$this->getUser()->getTeam();
        $entityManager = $this->getDoctrine()->getManager();
        $NewWeapon=($inventoryArmorRepository->findOneBy(array('inventory'=>$team->getInventory(),'armor'=>$armor)));
        if($NewWeapon->getQuantite()>0){
            if(!$player->getWeapon()==null){
                $CurrentWeapon=($inventoryArmorRepository->findOneBy(array('inventory'=>$team->getInventory(),'armor'=>$player->getArmor())));
                $CurrentWeapon->setQuantite($CurrentWeapon->getQuantite()+1);
            }
            $player->setArmor($armor);
            $NewWeapon->setQuantite($NewWeapon->getQuantite()-1);
        }
        $entityManager->flush();
        return $this->redirectToRoute('inventaire');
    }
}