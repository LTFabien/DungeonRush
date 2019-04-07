<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\InventoryArmorRepository")
 */
class InventoryArmor
{

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @Id @ORM\ManyToOne(targetEntity="App\Entity\Inventory", inversedBy="armor")
     */
    private $inventory;

    /**
     * @Id @ORM\ManyToOne(targetEntity="App\Entity\Armor", inversedBy="quantity")
     */
    private $armor;


    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getArmor(): ?Armor
    {
        return $this->armor;
    }

    public function setArmor(?Armor $armor): self
    {
        $this->armor = $armor;

        return $this;
    }
}
