<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\InventoryWeaponsRepository")
 */
class InventoryWeapons
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Inventory", inversedBy="weapons")
     */
    private $inventory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Weapons", inversedBy="quantity")
     */
    private $weapons;

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getWeapons(): ?Weapons
    {
        return $this->weapons;
    }

    public function setWeapons(?Weapons $weapons): self
    {
        $this->weapons = $weapons;

        return $this;
    }
}
