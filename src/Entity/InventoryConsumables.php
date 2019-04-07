<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\InventoryConsumablesRepository")
 */
class InventoryConsumables
{

    /**
     * @Id @ORM\ManyToOne(targetEntity="App\Entity\Consumables", inversedBy="quantity")
     * @Groups("Team")
     */
    private $consumables;

    /**
     * @Id @ORM\ManyToOne(targetEntity="App\Entity\Inventory", inversedBy="consumables")
     */
    private $inventory;

    /** @ORM\Column(type="integer") */
    private $quantite;


    public function getConsumables(): ?Consumables
    {
        return $this->consumables;
    }

    public function setConsumables(?Consumables $consumables): self
    {
        $this->consumables = $consumables;

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

    public function getQuantite()
    {
        return $this->quantite;
    }


    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

}
